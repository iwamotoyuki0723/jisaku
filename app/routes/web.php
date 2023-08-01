<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

// Route::get('/', function () {
//     return view('login');
// });




// Route::get('/', [DisplayController::class,'index'])->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/useradd', [DisplayController::class, 'useradd'])->name('user.add');
Route::post('/useradd', [DisplayController::class, 'addUser'])->name('user.add');
Route::post('/user/search', [DisplayController::class, 'userSearch'])->name('user.search');

Route::get('/inventory', [DisplayController::class, 'inventory'])->name('inventory');
Route::post('/inventory/search', [DisplayController::class, 'inventorysearch'])->name('inventory.search');

Route::get('/arrivalplan', [DisplayController::class, 'arrivalplan'])->name('arrivalplan');
Route::post('/arrivalplan/search', [DisplayController::class, 'arrivalplansearch'])->name('arrivalplans.search');
Route::get('/arrivalplan/create', [DisplayController::class, 'arrivalplancreate'])->name('arrivalplans.create');
Route::post('/arrivalplan', [DisplayController::class, 'arrivalplanadd'])->name('arrivalplans.add');
Route::post('/arrivalplan/{id}/confirm', [DisplayController::class, 'confirmArrivalplan'])->name('confirm.arrivalplans');
Route::get('/arrivalplans/clear', [DisplayController::class, 'clearArrivalplan'])->name('arrivalplans.clear');

Route::get('/product', [DisplayController::class, 'product'])->name('product');
Route::get('/product/create', [DisplayController::class, 'productcreate'])->name('products.create');
Route::post('/product/add', [DisplayController::class, 'productadd'])->name('products.add');
Route::get('/product/edit/{product_id}', [DisplayController::class, 'editproduct'])->name('products.edit');
Route::post('/product/edit/{product_id}', [DisplayController::class, 'productedit'])->name('products.editprocess');

Route::get('get_product_detail', [DisplayController::class, 'getProductDetail'])->name('get.product.detail');

Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
