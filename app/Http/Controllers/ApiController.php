<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;


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

    function CategoryByPost($id)
    {
        $posts = Product::with('relToCategory')->where('category_id',$id)->get();
        return response()->json($posts);

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
        $posts = Product::with('relToCategory')->take(6)->get();
        return response()->json($posts);

    }

    function CatWithProduct($id){

        $products = Product::with('relToCategory')->where('category_id',$id)
            ->get();
        return response()->json($products);
     }


//    Client controller

    function clientRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                password::min(5)
            ],
        ]);


        if (Client::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ])) {

            return response()->json([
                'message' => 'You are successfully Register',
                'title' => 'Success',
                'icon' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'User or Pass Does not match',
                'title' => 'Login Failed',
                'icon' => 'error',
            ]);
        }
    }


    function clientLogin(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $user = Client::where('email', '=', $email)->first();


        if (!$user) {
            return response()->json([
                'message' => 'User or Pass Does not match',
                'title' => 'Login Failed',
                'icon' => 'error',
            ]);
        } else {
            if (Hash::check($password, $user->password)) {

                $access_token = \AuthTwo::JWT($user);
                Session::put('Authorization', $access_token);

                Session::put('id', $user->id);
                Session::put('email', $user->email);
                Session::put('name', $user->name);

                return response()->json([
                    'message' => 'You are successfully Register',
                    'title' => 'Success',
                    'icon' => 'success',
                    'id'=>$user->id,
                    'email'=>$user->email,
                    'name'=>$user->name,
                    'Authorization' => $access_token,

                ]);
            }
        }
    }

    function customerLogout()
    {
        \AuthTwo::logout();
        return 1;
    }


    function updateProfileImage(Request $request){
//        $request->validate([
//            //'name' => 'required',
//            'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);

//        $image=$request->file('image');
//        //  $slug=Str::slug($request->name);
//        $slug="00";
//        $user=Client::where('id',$request->id)->first();
//        if ($user->photo=="default.png") {
//            $imageName=\FileHandler::nameGenerate($slug,$image);
//            \FileHandler::imageResize($image,500,500,$imageName);
//        } else  {
//            $imageName=\FileHandler::nameGenerate($slug,$image);
//            \FileHandler::fileDelete($user->photo,'uploads/profile/');
//            \FileHandler::imageResize($image,500,500,$imageName);
//        }
//        Client::where('id',$request->id)->update([
//            'name'=>$request->name,
//            'photo'=>\FileHandler::ServerURL($imageName),
//        ]);
//        return response()->json([
//            'message' => 'You are successfully Register',
//            'title' => 'Success',
//            'icon' => 'success',
//            ]);








        $upload_photo=$request->file('image');
        $extension = $upload_photo->getClientOriginalExtension();
        $fileName = 'c'.'_'.time().'.'.$extension;

        $user=Client::where('id',$request->id)->first();

        if ($user->photo=="default.png") {
            $request->file('image')->move(public_path('/uploads/clients/'), $fileName);
            Client::where('id',$request->id)->update([
                'name'=>$request->name,
                'photo'=>$fileName,
            ]);
            return response()->json([
                'message' => 'You are successfully Register',
                'title' => 'Success',
                'icon' => 'success',
            ]);
        } else  {
            $delete_from = public_path('/uploads/clients/'.$user->photo);
            unlink($delete_from);
            $request->file('image')->move(public_path('/uploads/clients/'), $fileName);
            Client::where('id',$request->id)->update([
                'name'=>$request->name,
                'photo'=>$fileName,
            ]);
            return response()->json([
                'message' => 'You are successfully Register',
                'title' => 'Success',
                'icon' => 'success',
            ]);
        }




    }

    function clientInfo($id){
         $clientinfo = Client::where('id',$id)->first();
        return response()->json($clientinfo);
    }





//    post pages

    public function SinglePost($id){
         $singlePost = Product::with('relToCategory')->where('id',$id)->first();
        return response()->json($singlePost);
    }

    public function getRelatedPost($postId){
         $categoryId = Product::where('id',$postId)->first()->category_id;
         $relPost = Product::with('relToCategory')->where('category_id',$categoryId)->skip(1)->take(3)->get();
        return response()->json($relPost);
    }




}


