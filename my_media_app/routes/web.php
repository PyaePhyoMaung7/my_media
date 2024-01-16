<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //admin profile
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class, 'updateAdminAccount'])->name('admin#update');

    //change password
    Route::get('change/password',[ProfileController::class, 'directChangePassowrd'])->name('admin#directChangePassword');
    Route::post('change/password',[ProfileController::class, 'changePassword'])->name('admin#changePassword');
    //admin list
    Route::get('admin/list',[ListController::class, 'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class, 'deleteAccount'])->name('admin#accountDelete');
    Route::post('admin/list',[ListController::class, 'adminSearch'])->name('admin#search');

    //category
    Route::get('category',[CategoryController::class, 'index'])->name('admin#category');
    Route::post('category',[CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('category/delete/{id}',[CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');
    Route::post('category/search',[CategoryController::class, 'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}',[CategoryController::class, 'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class, 'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('post',[PostController::class, 'index'])->name('admin#post');
    Route::post('post/create',[PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('post/delete/{id}',[PostController::class, 'deletePost'])->name('admin#deletePost');
    Route::get('post/update/{id}',[PostController::class, 'updatePostPage'])->name('admin#updatePostPage');
    Route::post('post/update/{id}',[PostController::class, 'updatePost'])->name('admin#updatePost');

    //trend post
    Route::get('trendPost',[TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class, 'trendPostDetails'])->name('admin#trendPostDetails');

});
