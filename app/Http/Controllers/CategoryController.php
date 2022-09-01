<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ar' => 'required',
            'category_image' => 'required|mimes:jpeg,png,jpg|image|max:1024',
        ], [
            'category_name_en.required' => 'Input Category English Name',
            'category_name_ar.required' => 'Input Category Arabic Name',
            'category_image.required' => 'Input Category Image',
            'category_image.image' => 'Please input image',
            'category_image.mimes' => 'Please input image',
            'category_image.max' => 'Please input image less than 1MB',
        ]);


        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/category', $name_gen);
        // Image::make($image)->resize(300, 300)->save('uploads/category/' . $name_gen);
        $save_url = 'uploads/category/' . $name_gen;

        Category::create([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ar' => str_replace(' ', '-', $request->category_name_ar),
            'category_image' => $save_url,

        ]);

        return to_route('category.create')->with('message', 'Category created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category_id = $request->id;
        $category = Category::findOrFail($category_id);
        $old_img = $category->category_image;

        $category->category_name_en = $request->category_name_en;
        $category->category_name_ar = $request->category_name_ar;
        $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_ar = str_replace(' ', '-', $request->category_name_ar);

        if ($request->file('category_image')) {

            unlink($old_img);
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/category', $name_gen);
            // Image::make($image)->resize(300, 300)->save('uploads/category/' . $name_gen);
            $save_url = 'uploads/category/' . $name_gen;

            $category->category_image = $save_url;
        }

        $category->update();

        return redirect()->back()->with('message', 'Category updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_categories = Category::findOrFail($id)->subCategories;
        foreach ($sub_categories as $sub_category) {
            $img = $sub_category->sub_category_image;
            unlink($img);

            $products = Product::where('sub_category_id', $sub_category->id);
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
        }
        $category = Category::findOrFail($id);

        $img = $category->category_image;
        unlink($img);

        $products = Product::where('category_id', $id);
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

        $category->delete();

        return redirect()->back()->with('message', 'Category deleted successfully');
    }
}
