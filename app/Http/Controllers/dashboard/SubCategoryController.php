<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subCategory(){
        $category = Category::all();
        $subCategory = SubCategory::all();
        $trashSubcategory = SubCategory::onlyTrashed()->get();

        return view('dashboard.subCategory.SubCategory',[
            'category' => $category,
            'subCategory' => $subCategory,
            'trashSubcategory' => $trashSubcategory,
        ]);
    }

    public function addSubCategory(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' =>'required'
        ]);
        if (SubCategory::where('category_id',$request->category_id)->where('subcategry_name',$request->subcategory_name)->exists()){

            return back()->with('error','This Subcategory already exists !');
        }else{
            Subcategory::insert([
                'category_id' => $request->category_id,
                'subcategry_name' => $request->subcategory_name ,
                'subcategry_slug' => strtolower(str_replace(' ','_',$request->subcategory_name)),
                'created_at' => Carbon::now(),
            ]);
            return back()->with('success','Add successfully');
        }
    }

    public function softDeleteSubCategory($id){
        SubCategory::find($id)->delete();
        return back()->with('delete','Deleted Successfully');
    }

    public function subCatHardDelete($id){
        SubCategory::onlyTrashed()->find($id)->forceDelete();
        return back()->with('hardDelete','Delete Successfully');
    }

    public function subCatReStore($id){
        SubCategory::onlyTrashed()->find($id)->restore();
        return back()->with('restore', 'Restore Successfully');
    }

    public function editSubCategory($id){
        $categories = Category::all();
        $subcategory_info = Subcategory::find($id);
        return view('dashboard.subCategory.EditSubCategory',[
            'categories' => $categories,
            'subcategory_info' => $subcategory_info,
        ]);
    }

    public function updateSubCategory(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' =>'required'
        ]);

        if (Subcategory::where('category_id',$request->category_id)->where('subcategry_name',$request->subcategory_name)->exists()){

            return back()->with('error','This Subcategory already exists in category !');
        }else{
            Subcategory::find($request->subcategory_id)->update([
                'category_id' => $request->category_id,
                'subcategry_name' => $request->subcategory_name,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('subCategory')->with('subcatupdate','Update successfully');
        }
    }


}


