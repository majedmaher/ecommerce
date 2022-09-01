<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        // if (Session::has('coupon')) {
        //     Session::forget('coupon');
        // }

        $id = $request->id;

        $product = Product::findOrFail($id);

        Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'qty' => $request->quantity,
            'price' => $product->discount_price ? $product->discount_price : $product->selling_price,
            'weight' => 1,
            'options' => [
                'image' => $product->product_thambnail,
                'color' => $request->color,
                'size' => $request->size,
            ],
        ]);

        $this->calculateDiscount();

        return response()->json(['success' => 'Successfully Added on Your Cart']);
    }

    public function refreshCount()
    {
        $count = Cart::count();
        return response()->json(['success' => $count]);
    }

    public function updateToCart(Request $request)
    {
        Cart::update($request->rowId, ['qty'  => $request->qty]);
        $this->calculateDiscount();
        return response()->json(['success' => 'Successfully Update on Your Cart']);
    }

    public function removeCart(Request $request)
    {
        Cart::remove($request->rowId);
        $this->calculateDiscount();
        return response()->json(['success' => 'Successfully Remove item from Your Cart']);
    }

    public function getTotal()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }
        return response()->json(array(
            'total' => Cart::total(),
        ));
    }

    public function calculateDiscount()
    {
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();


            Session::put('coupon', [
                'subtotal' => Cart::total(),
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }
    }
}
