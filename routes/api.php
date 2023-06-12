<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['CheckJWT']], function () {



});

Route::get('/categories',[ApiController::class,'categories']);
Route::get('/products',[ApiController::class,'Products']);
Route::get('/services',[ApiController::class,'services']);
Route::get('/clients',[ApiController::class,'clients']);



//apiroute
Route::post('/client_register',[ApiController::class,'clientRegister']);
//Route::get('/client_profile/{id}',[ApiController::class,'clientProfile'])->name('client.profile');
Route::post('/client_login',[ApiController::class,'clientLogin'])->name('client.login');


Route::get('/client_info/{id}',[ApiController::class,'clientInfo']);



Route::get('/clientLogout',[ApiController::class,'customerLogout']);
Route::post('/updateProfileImage',[ApiController::class,'updateProfileImage']);


//port
Route::get('/post/{id}',[ApiController::class,'SinglePost']);
Route::get('/category-post/{id}',[ApiController::class,'CategoryByPost']);
Route::get('/get-related-post/{id}', [ApiController::class, 'getRelatedPost']);
//Route::get('/categoriesp',[ApiController::class,'categoriesP']);
Route::get('/cat-with-product/{id}', [ApiController::class, 'CatWithProduct']);
