<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        return view('admin.product.create', compact('categories', 'sub_categories'));
    }

    public function store(ProductRequest $request)
    {
        $request->validate([
            'product_thambnail' => 'required|mimes:jpeg,png,jpg|image|max:1024',
            'multi_img.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'product_thambnail.image' => 'Please input image',
            'product_thambnail.mimes' => 'Please input image',
            'product_thambnail.max' => 'Please input image less than 1MB',
            'multi_img.*' => 'Please validate from multi images',

        ]);

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(917, 1000)->save('upload/products/thambnail/' . $name_gen);
        $image->move('uploads/products/thambnail', $name_gen);
        $save_url = 'uploads/products/thambnail/' . $name_gen;


        $product_id = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),

            'product_qty' => $request->product_qty,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_product_description_en' => $request->short_product_description_en,
            'short_product_description_ar' => $request->short_product_description_ar,
            'long_product_description_en' => $request->long_product_description_en,
            'long_product_description_ar' => $request->long_product_description_ar,
            'additional_information_en' => $request->additional_information_en,
            'additional_information_ar' => $request->additional_information_ar,
            'additional_information_items_en' => $request->additional_information_items_en,
            'additional_information_items_ar' => $request->additional_information_items_ar,

            'trandy' => $request->trandy ? '1' : '0',
            'just_arrived' => $request->just_arrived ? '1' : '0',
            'spring_collection' => $request->spring_collection ? '1' : '0',
            'summer_collection' => $request->summer_collection ? '1' : '0',
            'fall_collection' => $request->fall_collection ? '1' : '0',
            'winter_collection' => $request->winter_collection ? '1' : '0',
            'status' => $request->status ? '1' : '0',

            'product_thambnail' => $save_url,

        ])->id;


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            // Image::make($img)->resize(917, 1000)->save('upload/products/multi-images/' . $make_name);
            // $uploadPath = 'upload/products/multi-images/' . $make_name;
            $img->move('uploads/products/multi-images', $make_name);
            $uploadPath = 'uploads/products/multi-images/' . $make_name;
            MultiImg::create([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
            ]);
        }

        ////////// Een Multiple Image Upload Start ///////////

        return redirect()->back()->with('message', 'Product created successfully');
    }

    public function edit($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $sub_categories = SubCategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('categories', 'sub_categories', 'product', 'multiImgs'));
    }

    public function update(ProductRequest $request)
    {
        $product = Product::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),

            'product_qty' => $request->product_qty,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_product_description_en' => $request->short_product_description_en,
            'short_product_description_ar' => $request->short_product_description_ar,
            'long_product_description_en' => $request->long_product_description_en,
            'long_product_description_ar' => $request->long_product_description_ar,
            'additional_information_en' => $request->additional_information_en,
            'additional_information_ar' => $request->additional_information_ar,
            'additional_information_items_en' => $request->additional_information_items_en,
            'additional_information_items_ar' => $request->additional_information_items_ar,

            'trandy' => $request->trandy ? '1' : '0',
            'just_arrived' => $request->just_arrived ? '1' : '0',
            'spring_collection' => $request->spring_collection ? '1' : '0',
            'summer_collection' => $request->summer_collection ? '1' : '0',
            'fall_collection' => $request->fall_collection ? '1' : '0',
            'winter_collection' => $request->winter_collection ? '1' : '0',
            'status' => $request->status ? '1' : '0',

        ]);

        // Thimbnail

        if ($request->hasFile('product_thambnail')) {
            $request->validate([
                'product_thambnail' => 'required|mimes:jpeg,png,jpg|image|max:1024',
            ], [
                'product_thambnail.image' => 'Please input image',
                'product_thambnail.mimes' => 'Please input image',
                'product_thambnail.max' => 'Please input image less than 1MB',
            ]);

            unlink($request->old_img);

            $image = $request->file('product_thambnail');
            // $name_gen = time() . $image->getClientOriginalName();
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/products/thambnail', $name_gen);
            $save_url = 'uploads/products/thambnail/' . $name_gen;

            Product::findOrFail($request->id)->update([
                'product_thambnail' => $save_url,
            ]);
        }

        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function NewMuliImg(Request $request)
    {
        $request->validate([
            'multi_img.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'multi_img.*' => 'Please validate from multi images',

        ]);
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move('uploads/products/multi-images', $make_name);
            $uploadPath = 'uploads/products/multi-images/' . $make_name;
            MultiImg::create([
                'product_id' => $request->product_id,
                'photo_name' => $uploadPath,
            ]);
        }

        return redirect()->back()->with('message', 'Multi image added successfully');
    }

    public function MultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move('uploads/products/multi-images', $make_name);
            $uploadPath = 'uploads/products/multi-images/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
            ]);
            return redirect()->back()->with('message', 'Product updated successfully');
        }
    }
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        return redirect()->back()->with('message', 'image deleted successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        try {
            unlink($product->product_thambnail);
        } catch (\Throwable $th) {
            //throw $th;
        }
        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            try {
                unlink($img->photo_name);
            } catch (\Throwable $th) {
                //throw $th;
            }
            $img->delete();
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }
}
