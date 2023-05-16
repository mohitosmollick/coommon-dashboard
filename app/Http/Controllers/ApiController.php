<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use mysql_xdevapi\Result;

class ApiController extends Controller
{

     function categories(){
        $category = Category::orderBy('id','asc')->get([
            'id',
            'user_id',
            'category_name',
            'category_slug' ,
            'created_at',
        ]);
        return response()->json($category);
    }

    function services(){
        $service = Service::orderBy('id','asc')->get();
        return response()->json($service);
    }

    function clients(){
        $clients = Client::orderBy('id','desc')->get();
        return response()->json($clients);
    }

     function Products()
    {
        $posts = Product::get();
        return response()->json($posts);

    }

//    Client controller

    function clientRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                password::min(5)
            ],
        ]);

       if( Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ])){
           return response()->json([
               'message'=>'Register Successfully!!'
           ]);
       }else{
           return response()->json([
               'message'=>'Failed to Register !!'
           ]);
       }
    }


    function clientLogin(Request $request){
        if (Auth::guard('customerlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
//            if (Auth::guard('customerlogin')->user()->email_verified_at == null){
//                Auth::guard('customerlogin')->logout();
//                return redirect()->route('customer.register')->with('verify_at', 'Please verify your email');
//            }
            return response()->json([
                'user'=>Auth::guard('customerlogin')->user()->name,
                'userinfo'=>Auth::guard('customerlogin')->user()->profile_photo,
//                'logout' => Auth::guard('customerlogin')->logout(),
                'message'=>'Login Successfully!!',

            ]);
        }else{
            return response()->json([
                'message'=>'Failed to Login !!'
            ]);
        }
    }

    function customerLogout(){
        $logout = Auth::guard('customerlogin')->logout();
        return response()->json($logout);
    }







}
