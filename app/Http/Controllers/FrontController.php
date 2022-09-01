<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        Subscribe::create(['email' => $request->email]);
        return response()->json(['success' => 'Successfully Subscribe']);
    }

    public function contact(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'subject' => 'required',
        //     'message' => 'required',
        // ]);
        Contact::create(['name' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'message' => $request->message]);
        return response()->json(['success' => 'Successfully added contact']);
    }

    public function newsletter(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        // ]);
        Newsletter::create(['name' => $request->name, 'email' => $request->email]);
        return response()->json(['success' => 'Successfully added Your data']);
    }
}
