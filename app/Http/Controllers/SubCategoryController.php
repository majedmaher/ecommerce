<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Image;

class SubCategoryController extends Controller
{

    public function index()
    {
        $sub_categories = SubCategory::latest()->get();
        return view('admin.sub_category.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_name_en' => 'required',
            'sub_category_name_ar' => 'required',
            'sub_category_image' => 'required|mimes:jpeg,png,jpg|image|max:1024',
        ], [
            'category_id.required' => 'Choose Category',
            'sub_category_name_en.required' => 'Input Sub Category English Name',
            'sub_category_name_ar.required' => 'Input Sub Category Arabic Name',
            'sub_category_image.required' => 'Input Sub Category Image',
            'sub_category_image.image' => 'Please input image',
            'sub_category_image.mimes' => 'Please input image',
            'sub_category_image.max' => 'Please input image less than 1MB',
        ]);


        $image = $request->file('sub_category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/sub_category', $name_gen);
        // Image::make($image)->resize(300, 300)->save('uploads/sub_category/' . $name_gen);
        $save_url = 'uploads/sub_category/' . $name_gen;

        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_name_ar' => $request->sub_category_name_ar,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
            'sub_category_slug_ar' => str_replace(' ', '-', $request->sub_category_name_ar),
            'sub_category_image' => $save_url,

        ]);

        return to_route('sub_category.create')->with('message', 'Sub Category created successfully');
    }

    public function edit($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.sub_category.edit', compact('sub_category', 'categories'));
    }

    public function update(Request $request)
    {
        $sub_category_id = $request->id;
        $sub_category = SubCategory::findOrFail($sub_category_id);
        $old_img = $sub_category->sub_category_image;

        $sub_category->category_id = $request->category_id;
        $sub_category->sub_category_name_en = $request->sub_category_name_en;
        $sub_category->sub_category_name_ar = $request->sub_category_name_ar;
        $sub_category->sub_category_slug_en = strtolower(str_replace(' ', '-', $request->sub_category_name_en));
        $sub_category->sub_category_slug_ar = str_replace(' ', '-', $request->sub_category_name_ar);

        if ($request->file('sub_category_image')) {

            unlink($old_img);
            $image = $request->file('sub_category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/sub_category', $name_gen);
            // Image::make($image)->resize(300, 300)->save('uploads/sub_category/' . $name_gen);
            $save_url = 'uploads/sub_category/' . $name_gen;

            $sub_category->sub_category_image = $save_url;
        }

        $sub_category->update();

        return redirect()->back()->with('message', 'Sub Category updated successfully');
    }

    public function destroy($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $img = $sub_category->sub_category_image;
        unlink($img);

        $products = Product::where('sub_category_id', $id);
        foreach ($products as $product) {
            try {
                unlink($product->product_thambnail);
            } catch (\Throwable $th) {
                //throw $th;
            }
            $images = MultiImg::where('product_id', $id)->get();
            foreach ($images as $imgs) {
                try {
                    unlink($imgs->photo_name);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $imgs->delete();
            }
            $product->delete();
        }

        $sub_category->delete();

        return redirect()->back()->with('message', 'Sub Category deleted successfully');
    }
}
