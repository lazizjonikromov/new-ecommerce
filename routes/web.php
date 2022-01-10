<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/category/{product}', [ProductController::class, 'getCategoryProduct']);
Route::get('/product_detail/{product}', [ProductController::class, 'getProductDetail']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/shop/category/{product}', [ProductController::class, 'getShopCategoryProduct']);
Route::post('/addcart/{id}', [ProductController::class,'addcart']);
Route::get('/showcart', [ProductController::class,'showcart']);
Route::get('/delete/{id}', [ProductController::class,'deletecart']);
Route::get('/checkout', [ProductController::class,'checkout']);
Route::post('/order',[ProductController::class,'confirmorder']);
Route::get('/thankyou', [ProductController::class,'thankyou']);

Route::get('/contact-us', [HomeController::class, 'contact_us']);







Route::get('/admin/dashboard',
[
    'uses'=>'App\Http\Controllers\HomeController@getAdminDashboard',
    'middleware'=>'auth'

]
)->name("adminDashboard");

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/admin/add-product', [ProductController::class, 'create']);
Route::post('/admin/add-product', [ProductController::class, 'store']);
Route::get('/admin/edit-product/{product}', [ProductController::class, 'edit']);
Route::post('/admin/edit-product/{product}', [ProductController::class, 'update']);
Route::get('/admin/delete-product/{product}', [ProductController::class, 'delete']);
Route::get('/admin/search', [ProductController::class, 'search']);



Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/add-category', [CategoryController::class, 'create']);
Route::post('/admin/add-category', [CategoryController::class, 'store']);
Route::get('/admin/edit-category/{category}', [CategoryController::class, 'edit']);
Route::post('/admin/edit-category/{category}', [CategoryController::class, 'update']);
Route::get('/admin/delete-category/{category}', [CategoryController::class, 'delete']);
Route::get('/admin/search-category', [CategoryController::class, 'search']);


Route::get('/admin/showorder', [ProductController::class,'showorder']);
Route::get('/admin/search_order', [ProductController::class,'search_order']);
Route::get('/admin/updatestatus/{id}', [ProductController::class,'updatestatus']);







Route::get('/user/dashboard',
[
    'uses'=>'App\Http\Controllers\HomeController@getUserDashboard',
    'middleware'=>'auth'

]
)->name("userDashboard");
Route::get('/user/my_orders', [HomeController::class,'my_orders']);




require __DIR__.'/auth.php';