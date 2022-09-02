<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
// use Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function StripeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ], [
            'first_name.required' => 'Please Input your First Name',
            'last_name.required' => 'Please Input your Last Name',
            'email.required' => 'Please Input your Email Address',
            'email.email' => 'Please Input Valid Email Address',
            'mobile_number.required' => 'Please Input your Phone Number',
            'address_line_1.required' => 'Please Input your Address Line 1',
            'address_line_2.required' => 'Please Input your Address Line 2',
            'country.required' => 'Please Choose your Country',
            'city.required' => 'Please Input your City',
            'state.required' => 'Please Input your State',
            'zip_code.required' => 'Please Input your Zip Code',
            'payment_method.required' => 'Please Choose your Payment Method',
        ]);

        $data = $this->dataToArray($request);


        if ($request->payment_method == 'bank_transfer') {
            return view('payment.stripe', compact('data'));
        } elseif ($request->payment_method == 'paypal') {
            return to_route('processTransaction', ['data' => serialize($data)]);
        }
        return back();
    }

    public function StripeOrderBack($data)
    {
        return view('payment.stripe', compact('data'));
    }

    public function StripePost(Request $request)
    {
        // return 'asd';
        $validation = [
            'card_no' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvv' => 'required',
        ];

        $this->validate($request, $validation);

        $data = $this->dataToArray($request);
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        try {
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->card_no,
                    'exp_month' => $request->exp_month,
                    'exp_year'  => $request->exp_year,
                    'cvc'       => $request->cvv,
                ],
            ]);
            // return $token;
            $carts = Cart::content();
            $total = 0;
            foreach ($carts as $value) {
                $product = Product::select('id', 'discount_price', 'selling_price')->where('id', $value->id)->first();
                $total += ($product->discount_price ? $product->discount_price : $product->selling_price) * $value->qty;
            }
            if (Session::has('coupon')) {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name', $coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

                $total = $total - ($total * $coupon->coupon_discount / 100);
            }
            $total += 10;

            if (!isset($token['id'])) {
                Session::put('error', 'The Stripe Token was not generated correctly');
                return $this->StripeOrderBack($data);
            }
            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' => 'USD',
                'amount'   => $total,
                "description" => "This payment is tested",
                // "source" => $token['id'],
                'metadata' => ['order_id' => uniqid()],
            ]);
            if ($charge['status'] == 'succeeded') {
                // $charge_id = $charge['id'];
                // $amount = $charge['amount'];
                // $refund = $stripe->refunds()->create($charge_id, $amount / 100, ['reason' => 'requested_by_customer']);
                // return $refund;

                // return $charge;
                $order = Orders::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'address_line_1' => $request->address_line_1,
                    'address_line_2' => $request->address_line_2,
                    'country' => $request->country,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,

                    'payment_type' => 'Stripe',
                    'payment_method' => $charge['payment_method'],
                    'transaction_id' => $charge['balance_transaction'],
                    'currency' => $charge['currency'],
                    'amount' => $total,
                    'order_number' => $charge['metadata']['order_id'],

                    'invoice_no' => 'EC' . uniqid(),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'client_ip' => $token['client_ip'],
                ]);

                // Start Send Email 
                $data = [
                    'invoice_no' => $order->invoice_no,
                    'amount' => $total,
                    'name' => $order->first_name . ' ' . $order->last_name,
                    'email' => $order->email,
                ];

                Mail::to($request->email)->send(new OrderMail($data));

                // End Send Email 

                foreach ($carts as $cart) {
                    $product = Product::select('id', 'product_slug_en', 'discount_price', 'selling_price')->where('id', $cart->id)->first();

                    OrderItem::create([
                        'orders_id' => $order->id,
                        'product_id' => $product->id,
                        'product_slug' => $product->product_slug_en,
                        'color' => $cart->options->color,
                        'size' => $cart->options->size,
                        'qty' => $cart->qty,
                        'price' => $product->discount_price ? $product->discount_price : $product->selling_price,

                    ]);
                }
                if (Session::has('coupon')) {
                    Session::forget('coupon');
                }

                Cart::destroy();

                return redirect()
                    ->route('index')
                    ->with('success', 'Transaction complete.');
            } else {
                Session::put('error', 'Money not add in wallet!!');
                return $this->StripeOrderBack($data);
            }
        } catch (Exception $e) {
            Session::put('error', $e->getMessage());
            return $this->StripeOrderBack($data);
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            Session::put('error', $e->getMessage());
            return $this->StripeOrderBack($data);
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            Session::put('error', $e->getMessage());
            return $this->StripeOrderBack($data);
        }
    }

    public function dataToArray($request)
    {
        $data = array();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['mobile_number'] = $request->mobile_number;
        $data['address_line_1'] = $request->address_line_1;
        $data['address_line_2'] = $request->address_line_2;
        $data['country'] = $request->country;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['zip_code'] = $request->zip_code;
        $data['payment_method'] = $request->payment_method;
        return $data;
    }
}
