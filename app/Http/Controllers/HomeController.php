<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
class HomeController extends Controller
{
//    public function redirect()
//    {
//        $userType = Auth::user()->usertype;
//        if($userType == "1")
//        {
//            return view('admin.home');
//        }
//        else{
//            $products = Product::all();
//            return view('home.userPage');
//        }
//    }

    public function index()
    {
        if(Auth::user()){
            $userType = Auth::user()->usertype;
            if($userType == "1")
            {
                return view('admin.home');
            }
            else{
                $products = Product::all();
                return view('home.userPage',compact('products'));
            }
        }else{
            $products = Product::all();
            return view('home.userPage',compact('products'));
        }


    }
}
