<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/admin_panel', [BackendController::class, 'welcome'])->name('dashboard');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// users
Route::get('/users',[UserController::class, 'userList'])->name('users');
Route::get('/user_delete/{user_id}',[UserController::class, 'userDelete'])->name('user_delete');
Route::get('/edit_user',[UserController::class, 'editUser'])->name('edit_user');
Route::get('/update_user',[UserController::class, 'updateUser'])->name('update_user');




//category
Route::post('/category/insert',[CategoryController::class,'categoryInsert'])->name('category_insert');

Route::get('/add_category',[CategoryController::class,'addCategory'])->name('add_category');
Route::get('/edit_category/{cat_id}',[CategoryController::class,'editCategory'])->name('edit_category');

Route::post('/update_category',[CategoryController::class,'updateCategory'])->name('update_category');

Route::get('/soft_delete_category/{cat_id}',[CategoryController::class,'softDeleteCategory'])->name('soft_delete_category');
Route::get('/hard_delete_category/{cat_id}',[CategoryController::class,'hardDeleteCategory'])->name('hard_delete_category');
Route::get('/restore_category/{cat_id}',[CategoryController::class,'restoreCategory'])->name('restore_category');

Route::post('/mark/soft_delete_category',[CategoryController::class,'markSoftDeleteCategory'])->name('mark.soft_delete_category');
Route::post('/mark/restore_category',[CategoryController::class,'markRestoreCategory'])->name('mark.restore_category');
