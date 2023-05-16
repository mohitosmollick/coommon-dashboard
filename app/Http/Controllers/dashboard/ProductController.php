<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function productList(){
        $product = Product::all();
        $trashProduct = Product::onlyTrashed()->get();
        return view('dashboard.Product.ProductList',[
            'product' => $product,
            'trashProduct' => $trashProduct,
        ]);
    }
    public function addingProduct(){
        $category = Category::all();
        $subCategory = SubCategory::all();
        return view('dashboard.Product.AddProduct',[
            'category' => $category,
            'subCategory' => $subCategory,
        ]);
    }

    function getSubCategory(Request $request){
        $subcategory =  Subcategory::where('category_id',$request->category_id)->get();
        $str =  '<option value="">--Select Sub Category--</option>';
        foreach ($subcategory as $subcat){
            $str .= '<option value="'.$subcat->id.'">'.$subcat->subcategry_name.'</option>';
        }
        echo $str;
    }

    public function addProduct(Request $request){
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','_',$request->product_name)),
            'product_price' => $request->product_price,
            'discount' => $request->product_discount,
            'after_discount' =>$request->product_price - ($request->product_price*$request->product_discount)/100,
            'sort_desp' => $request->short_des,
            'long_desp' => $request->long_desc,

        ]);

        $request->validate([
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10100',
        ]);
        $upload_image = $request->product_image;
        $extention = $upload_image->getClientOriginalExtension();
        $file_name = $product_id.'.'.$extention;
        $request->product_image->move(public_path('/uploads/products/'), $file_name);
        Product::find($product_id)->update([
            'preview' => $file_name,
        ]);


        return back()->with('success', 'Product added successfully');
    }

    public function editProduct($product_id){
        $category = Category::all();
        $subCategory = SubCategory::all();
        $products = Product::find($product_id);
        return view('dashboard.Product.EditProduct',[
            'category' => $category,
            'subCategory' => $subCategory,
            'products' => $products,
        ]);
    }

    public function updateProduct(Request $request){

        $product_id = Product::find($request->product_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','_',$request->product_name)),
            'product_price' => $request->product_price,
            'discount' => $request->product_discount,
            'after_discount' =>$request->product_price - ($request->product_price*$request->product_discount)/100,
            'sort_desp' => $request->short_des,
            'long_desp' => $request->long_desc,
            'updated_at' => Carbon::now(),

        ]);

//        $request->validate([
//            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10100',
//        ]);
//        $upload_image = $request->product_image;
//        $extention = $upload_image->getClientOriginalExtension();
//        $file_name = $product_id.'.'.$extention;
//        $request->product_image->move(public_path('/uploads/products/'), $file_name);
//        Product::find($product_id)->update([
//            'preview' => $file_name,
//        ]);


        return back()->with('success', 'Product added successfully');
    }

    public function softDeleteProduct($id){
        Product::find($id)->delete();
        return back()->with('soft_delete', 'Delete successfully');
    }


    public function productReStore($id){
        Product::onlyTrashed()->find($id)->restore();
        return back()->with('restore', 'Restore successfully');

    }

    public function deleteProduct($product_id){
        $find_product = Product::onlyTrashed()->find($product_id);
        $delete_from = public_path('/uploads/products/'.$find_product->preview);
        unlink($delete_from);
        Product::onlyTrashed()->find($product_id)->forceDelete();
        return back();
    }






}
