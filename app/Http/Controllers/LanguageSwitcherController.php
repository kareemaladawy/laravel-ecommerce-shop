<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageSwitcherController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($locale)
    {
        if (array_key_exists($locale, config('languages'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
