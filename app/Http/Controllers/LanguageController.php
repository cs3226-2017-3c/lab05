<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // if (array_key_exists($lang, Config::get('languages'))) {
        //     //Session::set('applocale', $lang);
        //     App::setLocale($lang);
        // }
        if (!\Session::has('locale')){
        	\Session::put('locale',$lang);
        } else {
        	Session::put('locale',$lang);
        }
        return Redirect::back();
    }
}