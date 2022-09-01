<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;

class UIController extends Controller
{
    public function index()
    {
        $categories = Category::getData()->withCount('products')->take(3)->get();
        $sub_categories = SubCategory::getData()->withCount('products')->take(3)->get();

        $lang = getLanguage();

        $trandy_products = Product::productMainData($lang)->where('trandy', 1)->take(8)->get();
        $just_arrived = Product::productMainData($lang)->where('just_arrived', 1)->take(8)->get();

        $vendors = Vendor::all();
        return view('index', compact('categories', 'sub_categories', 'trandy_products', 'just_arrived', 'vendors'));
    }

    public function cart()
    {
        // Cart::destroy();
        $carts = Cart::content();
        $cartTotal = Cart::total();
        return view('cart', compact('carts', 'cartTotal'));
    }

    public function checkout()
    {

        $carts = Cart::content();
        $cartTotal = Cart::total();
        // foreach ($carts as $value) {
        //     $value->discount = $value->price * 0.50;
        // }

        // return $carts;
        return view('checkout', compact('carts', 'cartTotal'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function detail($product_slug)
    {
        $lang = getLanguage();
        $anotherLang = $lang == 'ar' ? 'en' : 'ar';

        $product = Product::productDetails($lang, $product_slug)->with('multiImgs')->where('product_slug_' . $lang, $product_slug)->first();
        if (!$product) {
            $product = Product::productDetails($lang, $product_slug)->with('multiImgs')->where('product_slug_' . $anotherLang, $product_slug)->first();
        }
        return view('detail', compact('product'));
    }

    public function shop()
    {
        $lang = getLanguage();
        $products = Product::productMainData($lang)->paginate(9);
        // return $products;
        return view('shop', compact('products'));
    }

    public function CategoryProducts($category_slug)
    {
        $lang = getLanguage();
        $anotherLang = $lang == 'ar' ? 'en' : 'ar';
        $data = Category::getData()->where('category_slug_' . $lang, $category_slug)->with(['products' => function ($query) use ($lang) {
            $query->productMainData($lang);
        }])->first();
        if (!$data) {
            $data = Category::getData()->where('category_slug_' . $anotherLang, $category_slug)->with(['products' => function ($query) use ($lang) {
                $query->productMainData($lang);
            }])->first();
        }
        return view('products-show', compact('data'))->with('page', 'category');
    }

    public function SubCategoryProducts($sub_category_slug)
    {
        $lang = getLanguage();
        $anotherLang = $lang == 'ar' ? 'en' : 'ar';
        $data = SubCategory::getData()->where('sub_category_slug_' . $lang, $sub_category_slug)->with(['products' => function ($query) use ($lang) {
            $query->productMainData($lang);
        }])->first();
        if (!$data) {
            $data = SubCategory::getData()->where('sub_category_slug_' . $anotherLang, $sub_category_slug)->with(['products' => function ($query) use ($lang) {
                $query->productMainData($lang);
            }])->first();
        }
        return view('products-show', compact('data'))->with('page', 'sub_category');
    }
}
