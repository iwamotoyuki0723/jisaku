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




Route::get('/', [DisplayController::class,'index'])->name('home');

Route::get('/useradd', [DisplayController::class, 'useradd'])->name('user.add');
Route::get('/inventory', [DisplayController::class, 'inventory'])->name('inventory');
Route::post('/inventory/search', [DisplayController::class, 'search'])->name('inventory.search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
