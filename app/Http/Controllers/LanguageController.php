<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function ChangeLanguage()
    {
        if (getLanguage() == 'ar') {
            session()->forget('language');
            Session::put('language', 'en');
            return redirect()->back();
        } else {
            session()->forget('language');
            Session::put('language', 'ar');
            return redirect()->back();
        }
    }
}
