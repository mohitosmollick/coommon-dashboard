<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function userList(){
        $users = User::where('id', '!=' , Auth::id())->simplePaginate(5);
        $total_users = User::count();
        $trash_users = User::onlyTrashed()->get();
        return view('dashboard.users.userList',[
            'users' => $users,
            'total_user' => $total_users,
            'trash_users' => $trash_users,
        ]);

    }

    public function userDelete($user_id){
        User::find($user_id)->delete();
        return back();
    }

    public function userHardDelete($user_id){
        User::onlyTrashed()->find($user_id)->forceDelete();
        return back();
    }

    public function restoreUser($user_id){
        User::onlyTrashed()->find($user_id)->restore();
        return back();
    }

    public function profile(){
        return view('dashboard.users.editUser');
    }

    public  function updateProfile(Request $request){
        User::find(Auth::id())->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Name Updated Successfully');
    }

    public function passwordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'confirmed',
                'required',
                Password::min(8)
            ],
            'password_confirmation' => 'required',
        ]);

        if (Hash::check($request->old_password,Auth::user()->password)){
            if (Hash::check($request->password,Auth::user()->password)){
                return back()->with('taken_pass','This Password already taken');
            }else{
                User::find(Auth::id())->update([
                    'password' => $request->password,
                    'updated_at' => Carbon::now(),
                ]);

                return back()->with('success_pass','Password Change successfully');
            }

        }else{
            return back()->with('wrong_pass','Please input Correct Password');
        }

    }



    public function updateProfileImage(Request $request){
        $request->validate([
            'profile_photo' => 'mimes:jpg,bmp,png|file|max:1024',

        ]);

        $upload_photo = $request->profile_photo;
        $extension = $upload_photo->getClientOriginalExtension();
        $filename = Auth::id().'.'.$extension;

        if (Auth::user()->profile_img == 'default.png'){
            $request->profile_photo->move(public_path('/uploads/users'), $filename);
            User::find(Auth::id())->update([
                'profile_img' => $filename,
            ]);
            return back();
        }else{
            $delete_img = public_path('/uploads/users/'.Auth::user()->profile_img);
            unlink($delete_img);

            $request->profile_photo->move(public_path('/uploads/users'), $filename);
            User::find(Auth::id())->update([
                'profile_img' => $filename,
            ]);
            return back();

        }


    }
}
