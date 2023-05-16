<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ClientConroller;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\subCategoryController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\ServiceController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;



Route::get('/admin_panel', [BackendController::class, 'welcome'])->name('dashboard');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin users
Route::get('/users',[UserController::class, 'userList'])->name('users');
Route::get('/user_delete/{user_id}',[UserController::class, 'userDelete'])->name('user_delete');
Route::get('/user_hard_delete/{user_id}',[UserController::class, 'userHardDelete'])->name('user_hard_delete');
Route::get('/restore_user/{user_id}',[UserController::class, 'restoreUser'])->name('restore_user');
Route::get('/edit_user',[UserController::class, 'editUser'])->name('edit_user');

// Customers
Route::get('/customers',[ClientConroller::class, 'customers'])->name('customers');

//Services
Route::get('/add/services',[ServiceController::class, 'addServices'])->name('add.services');
Route::get('/services/list',[ServiceController::class, 'servicesList'])->name('services.list');
Route::post('/service/insert',[ServiceController::class, 'serviceInsert'])->name('services.insert');
Route::post('/service/soft_delete',[ServiceController::class, 'SoftDeleteService'])->name('soft.delete.service');
Route::post('/edit/service',[ServiceController::class, 'editService'])->name('edit.edit');


// Edit Admin users
Route::get('/profile',[UserController::class, 'profile'])->name('profile');
Route::post('/update_profile',[UserController::class, 'updateProfile'])->name('update_profile');
Route::post('/update/password',[UserController::class, 'passwordUpdate']);
Route::post('/user_photo_update',[UserController::class, 'userPhotoUpdate'])->name('userPhotoUpdate');

//category
Route::post('/category/insert',[CategoryController::class,'categoryInsert'])->name('category_insert');
Route::get('/add_category',[CategoryController::class,'addCategory'])->name('add_category');
Route::get('/edit_category/{cat_id}',[CategoryController::class,'editCategory'])->name('edit_category');
Route::post('/update_category',[CategoryController::class,'updateCategory'])->name('update_category');
Route::get('/soft_delete_category/{cat_id}',[CategoryController::class,'softDeleteCategory'])->name('soft_delete_category');
Route::get('/hard_delete_category/{cat_id}',[CategoryController::class,'hardDeleteCategory'])->name('hard_delete_category');
Route::get('/restore_category/{cat_id}',[CategoryController::class,'restoreCategory'])->name('restore_category');
//Mark system
Route::post('/mark/soft_delete_category',[CategoryController::class,'markSoftDeleteCategory'])->name('mark.soft_delete_category');
Route::post('/mark/restore_category',[CategoryController::class,'markRestoreCategory'])->name('mark.restore_category');

//subcategory
Route::get('/sub_category',[SubCategoryController::class,'subCategory'])->name('subCategory');
Route::post('/add_sub_category',[SubCategoryController::class,'addSubCategory'])->name('add_subCategory');
Route::get('/edit_sub_category/{id}',[SubCategoryController::class,'editSubCategory'])->name('edit_sub_category');
Route::post('/update_sub_category',[SubCategoryController::class,'updateSubCategory'])->name('update_sub_categories');
Route::get('/soft_delete_subCat/{id}',[SubCategoryController::class,'softDeleteSubCategory'])->name('soft_delete_subCat');
Route::get('/subCat_hard_delete/{id}',[SubCategoryController::class,'subCatHardDelete'])->name('subCat_hard_delete');
Route::get('/subCat_reStore/{id}',[SubCategoryController::class,'subCatReStore'])->name('subCat_reStore');

//Product
Route::get('/product_list',[ProductController::class,'productList'])->name('product_list');
Route::get('/adding_product',[ProductController::class,'addingProduct'])->name('adding_product');
Route::post('/add_product',[ProductController::class,'addProduct'])->name('add_product');
Route::post('/getSubCategory',[ProductController::class,'getSubCategory']);
Route::get('/edit_product/{product_id}',[ProductController::class,'editProduct'])->name('edit_product');
Route::post('/update_product',[ProductController::class,'updateProduct'])->name('update_product');
Route::get('/soft_delete_product/{id}',[ProductController::class,'softDeleteProduct'])->name('soft_delete_product');
Route::get('/delete_product/{product_id}',[ProductController::class,'deleteProduct'])->name('delete_product');
Route::get('/product_reStore/{id}',[ProductController::class,'productReStore'])->name('product_reStore');





