<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function userList(){
        $users = User::where('id', '!=' , Auth::id())->simplePaginate(2);
        $total_users = User::count();
        return view('dashboard.users.userList',[
            'users' => $users,
            'total_user' => $total_users
        ]);

    }

    public function userDelete($user_id){
        User::find($user_id)->delete();
        return back();
    }


    public function editUser(){
        return view('dashboard.users.editUser');
    }

//    public function updateName(Request $request){
//        User::find(Auth::id())->update([
//            'name' => $request-> user_name,
//            'updated_at' => Carbon::now(),
//        ]);
//        return back()->with('success','Profile Name updated Successfully');
//    }

//    public function updatePassword(Request $request){
//
//        $request->validate([
//            'old_password' => 'required',
//            'password' => [
//                'confirmed',
//                'required',
//                Password::min(8)
//
//
//            ],
//            'password_confirmation' => 'required',
//        ]);
//
//        if (Hash::check($request->old_password,Auth::user()->password)){
//            if (Hash::check($request->password,Auth::user()->password)){
//                return back()->with('taken_pass','This Password already taken');
//            }else{
//                User::find(Auth::id())->update([
//                    'password' => $request->password,
//                    'updated_at' => Carbon::now(),
//                ]);
//            }
//
//        }else{
//            return back()->with('wrong_pass','Please input Correct Password');
//        }
//    }

    public function updateProfileImage(Request $request){
        $request->validate([
            'profile_photo' => 'mimes:jpg,bmp,png|file|max:1024',

        ]);

        $upload_photo = $request->profile_photo;
        $extension = $upload_photo->getClientOriginalExtension();
        $filename = Auth::id().'.'.$extension;

        if (Auth::user()->profile_img == 'profile.png'){
            $request->profile_photo->move(public_path('/dashboard/images/profile'), $filename);
            User::find(Auth::id())->update([
                'profile_img' => $filename,
            ]);
            return back();
        }else{
            $delete_img = public_path('/dashboard/images/profile/'.Auth::user()->profile_img);
            unlink($delete_img);

            $request->profile_photo->move(public_path('/dashboard/images/profile'), $filename);
            User::find(Auth::id())->update([
                'profile_img' => $filename,
            ]);
            return back();

        }


    }
}