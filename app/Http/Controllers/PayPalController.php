<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{

    public function processTransaction(Request $request)
    {
        $data = $request->get('data');
        // return unserialize($data);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $carts = Cart::content();

        $total = 0;
        foreach ($carts as $key => $value) {
            $product = Product::select('id', 'discount_price', 'selling_price')->where('id', $value->id)->first();
            $total += ($product->discount_price ? $product->discount_price : $product->selling_price) * $value->qty;
        }
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

            $total = $total - ($total * $coupon->coupon_discount / 100);
        }
        $total += 10;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction', ['data' => $data]),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('cart')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('cart')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $data = unserialize($request->get('data'));

        // return unserialize($data);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $order = Orders::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'address_line_1' => $data['address_line_1'],
                'address_line_2' => $data['address_line_2'],
                'country' => $data['country'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip_code' => $data['zip_code'],

                'payment_type' => 'Paypal',
                'payment_method' => 'Paypal',
                'transaction_id' => $response['purchase_units'][0]['payments']['captures'][0]['id'],
                'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                'order_number' => uniqid(),

                'invoice_no' => 'EC' . uniqid(),
                'order_date' => Carbon::now()->format('d F Y'),
                'client_ip' => request()->ip(),
            ]);

            // Start Send Email 
            $data = [
                'invoice_no' => $order->invoice_no,
                'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                'name' => $order->first_name . ' ' . $order->last_name,
                'email' => $order->email,
            ];

            Mail::to($order->email)->send(new OrderMail($data));

            // End Send Email 
            $carts = Cart::content();
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
            return redirect()
                ->route('cart')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('cart')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
