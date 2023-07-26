<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;

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
Route::get('/inventory', [DisplayController::class, 'inventory'])->name('inventory');
Route::post('/inventory/search', [DisplayController::class, 'inventorysearch'])->name('inventory.search');
Route::get('/arrivalplan', [DisplayController::class, 'arrivalplan'])->name('arrivalplan');
Route::post('/arrivalplan/search', [DisplayController::class, 'arrivalplansearch'])->name('arrivalplans.search');
Route::get('/arrivalplan/create', [DisplayController::class, 'arrivalplancreate'])->name('arrivalplans.create');
Route::post('/arrivalplan', [DisplayController::class, 'arrivalplanadd'])->name('arrivalplans.add');
Route::get('/product', [DisplayController::class, 'product'])->name('product');
Route::get('/product/create', [DisplayController::class, 'productcreate'])->name('products.create');
Route::post('/product/add', [DisplayController::class, 'productadd'])->name('products.add');
Route::get('/product/edit', [DisplayController::class, 'editproduct'])->name('products.edit');
Route::post('/product/edit', [DisplayController::class, 'productedit'])->name('products.edit');