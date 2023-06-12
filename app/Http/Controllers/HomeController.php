<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    public function Login(){
        return view('dashboard.Auth.Login');
    }
    public function Register(){
        return view('dashboard.Auth.Register');
    }
    public function index()
    {
        return view('home');
    }

    function UserRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);


        if (User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ])) {

            Session::put('email', $request->email);
            Session::put('password', $request->password);

            return redirect('/admin/login/form')->with('success','Register successfully');

        } else {

            return  back()->with('fail','Register Fail');

        }
    }

    function UserLogin(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();


        if (!$user) {
            return back()->with('error', 'Login Fail, please check email id');
        } else {
            if (Hash::check($password, $user->password)) {

                $access_token = \Auth::JWT($user);
                Session::put('Authorization', $access_token);

                Session::put('id', $user->id);
                Session::put('email', $user->email);
                Session::put('name', $user->name);

                return redirect('/')->with('success','Login successfully');
            } else {
                return  back()->with('fail','Login Fail');

            }
        }
    }

    function Logout(){
        \Auth::logout();
        return redirect('/admin/login/form')->with('success','Login successfully');
    }


}
