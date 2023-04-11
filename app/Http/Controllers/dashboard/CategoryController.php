<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    public function addCategory(){
        $all_category = Category::all();
        $trash_category = Category::onlyTrashed()->get();
        return view('dashboard.Category.AddCategory',[
            'all_category' => $all_category,
            'trash_category' => $trash_category,
        ]);
    }


    public function categoryInsert(CategoryRequest $request) {

        Category::insert([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','_',$request->category_name)),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success','-> added successfully');
    }

    public function softDeleteCategory($cat_id){
        Category::find($cat_id)->delete();
        return back()->with('delete','-> delete successfully');
    }

    public  function editCategory($cat_id){
        $Categories = Category::find($cat_id);
        return view('dashboard.Category.EditCategory',[
            'Categories'=> $Categories,
        ]);

    }

    public function updateCategory(Request $request){
        Category::find($request->id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','_',$request->category_name)),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('add_category')->with('success','->Updated successfully');
    }


    public function restoreCategory($cat_id){
        Category::onlyTrashed()->find($cat_id)->restore();
        return back();

    }

    public function hardDeleteCategory($cat_id){
        Category::onlyTrashed()->find($cat_id)->forceDelete();
        return back();
    }

    public function markSoftDeleteCategory(Request $request){
        foreach ($request->mark as $mark){
            Category::find($mark)->delete();
        }
        return back();
    }

    public function markRestoreCategory(Request $request){
        foreach ($request->delete as $delete){
            Category::withTrashed()->find($delete)->restore();
//            Category::withTrashed()->find($delete)->forceDelete();
        }
        return back();
    }



}
