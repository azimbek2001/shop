<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\CrossController;
use App\Http\Controllers\DostController;
use App\Http\Controllers\CommentsController;



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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::apiResource('comments',CommentsController::class)->only([
   'store'
]);
 Route::apiResource('favorites',FavoriteController::class)->only([
   'store','destroy'
]);
   Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
	], function($router){
	Route::get('/admin', [AuthController::class, 'admin']);    
    Route::apiResource('products',ProductsController::class);
    Route::apiResource('categories',CategoriesController::class);
    Route::apiResource('comments',CommentsController::class);  
    Route::apiResource('payments',PaymentsController::class);  
    Route::apiResource('cross_sells',CrossController::class);  
    Route::apiResource('dostinfos',DostController::class);  

    Route::apiResource('users',UserController::class)->only([
   'index','show','update','destroy'
]);  ;  



    });	
});
Route::get('/products',[MainController::class,'showProducts']);
Route::get('/products/{id}',[MainController::class,'showProduct']);
Route::get('/categories/{id}',[MainController::class,'showCategory']);
Route::get('/categories',[MainController::class,'showCategories']);
Route::get('/dostinfos',[MainController::class,'showDostInfos']);
Route::get('/payments',[MainController::class,'showPayments']);
Route::get('/populars',[MainController::class,'showPopulars']);
Route::get('/cross_sells',[MainController::class,'showCrossSells']);




