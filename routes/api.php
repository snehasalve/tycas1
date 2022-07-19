<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Food_itemController;
use App\Http\Controllers\Food_customization_typesController;
use App\Http\Controllers\Food_customization_optionController;
use App\Http\Controllers\Food_size_optionController;
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

//Clients
Route::get('/clients',[ClientController::class,'index']);
Route::post('/clients',[ClientController::class,'store']);
Route::get('/clients/{id}',[ClientController::class,'show']);
Route::put('/clients/{id}',[ClientController::class,'update']);
Route::delete('/clients/{id}',[ClientController::class,'destroy']);


//Users
Route::get('/users',[UserController::class,'index']);
Route::post('/users',[UserController::class,'store']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'destroy']);


//Category
Route::get('/cats',[CategoryController::class,'index']);
Route::post('/cats',[CategoryController::class,'store']);
Route::get('/cats/{id}',[CategoryController::class,'show']);
Route::put('/cats/{id}',[CategoryController::class,'update']);
Route::delete('/cats/{id}',[CategoryController::class,'destroy']);

//Food_item
Route::get('/foodItems',[Food_itemController::class,'index']);
Route::post('/foodItems',[Food_itemController::class,'store']);
Route::get('/foodItems/{id}',[Food_itemController::class,'show']);
Route::put('/foodItems/{id}',[Food_itemController::class,'update']);
Route::delete('/foodItems/{id}',[Food_itemController::class,'destroy']);


//Food Customization type

Route::get('/foodCustType',[Food_customization_typesController::class,'index']);
Route::post('/foodCustType',[Food_customization_typesController::class,'store']);
Route::get('/foodCustType/{id}',[Food_customization_typesController::class,'show']);
Route::put('/foodCustType/{id}',[Food_customization_typesController::class,'update']);
Route::delete('/foodCustType/{id}',[Food_customization_typesController::class,'destroy']);


//Food Customization option

Route::get('/foodCustOpt',[Food_customization_optionController::class,'index']);
Route::post('/foodCustOpt',[Food_customization_optionController::class,'store']);
Route::get('/foodCustOpt/{id}',[Food_customization_optionController::class,'show']);
Route::put('/foodCustOpt/{id}',[Food_customization_optionController::class,'update']);
Route::delete('/foodCustOpt/{id}',[Food_customization_optionController::class,'destroy']);


//Food size option
Route::get('/foodSizeOpt',[Food_size_optionController::class,'index']);
Route::post('/foodSizeOpt',[Food_size_optionController::class,'store']);
Route::get('/foodSizeOpt/{id}',[Food_size_optionController::class,'show']);
Route::put('/foodSizeOpt/{id}',[Food_size_optionController::class,'update']);
Route::delete('/foodSizeOpt/{id}',[Food_size_optionController::class,'destroy']);
