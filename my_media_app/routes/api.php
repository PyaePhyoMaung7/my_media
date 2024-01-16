<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//log in
Route::post('user/login',[AuthController::class, 'login']);

//register
Route::post('user/register',[AuthController::class, 'register']);


Route::get('category',[AuthController::class, 'categoryList'])->middleware('auth:sanctum');

//post
Route::get('allPostList',[PostController::class, 'getAllPosts']);
Route::post('post/search',[PostController::class, 'postSearch']);
Route::post('post/details',[PostController::class, 'postDetails']);

//category
Route::get('allCategoryList',[CategoryController::class, 'getAllCategories']);
Route::post('category/search',[CategoryController::class, 'categorySearch']);

//action log
Route::post('post/actionLog',[ActionLogController::class, 'setActionLog']);
