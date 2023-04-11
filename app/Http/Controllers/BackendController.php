<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function welcome(){
        $login_user = Auth::user()->name;
        return view('dashboardhome',compact('login_user'));
    }


}
