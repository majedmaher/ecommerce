<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('admin.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.create');
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
            'photo_name' => 'required|mimes:jpeg,png,jpg|image|max:1024',
        ], [
            'photo_name.required' => 'Input vendor Image',
            'photo_name.image' => 'Please input image',
            'photo_name.mimes' => 'Please input image',
            'photo_name.max' => 'Please input image less than 1MB',
        ]);


        $image = $request->file('photo_name');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/vendor', $name_gen);
        // Image::make($image)->resize(300, 300)->save('uploads/vendor/' . $name_gen);
        $save_url = 'uploads/vendor/' . $name_gen;

        Vendor::create([
            'photo_name' => $save_url,

        ]);

        return to_route('vendor.create')->with('message', 'vendor created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vendor_id = $request->id;
        $vendor = Vendor::findOrFail($vendor_id);
        $old_img = $vendor->photo_name;

        if ($request->file('photo_name')) {

            unlink($old_img);

            $save_url = saveImage($request->file('photo_name'), 'vendor');

            $vendor->photo_name = $save_url;
        }

        $vendor->update();

        return redirect()->back()->with('message', 'vendor updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $vendor = Vendor::findOrFail($id);

        $img = $vendor->photo_name;
        unlink($img);
        $vendor->delete();

        return redirect()->back()->with('message', 'vendor deleted successfully');
    }
}
