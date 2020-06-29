<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

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

// Auth Routes

Route::get('/login', 'authController@login');
Route::post('postLogin', 'authController@postLogin');
Route::get('register', 'authController@register');
Route::post('postRegister', 'authController@postRegister');
Route::get('logout', 'authController@logout')->name('logout');

// Page Routes

Route::get('/', 'FoodController@home');
Route::get('/show/{id}', 'FoodController@show');
Route::post('/edit', 'FoodController@update');
Route::get('category/{cate}', 'FoodController@category');
Route::post('delete/food/{id}', "FoodController@destroy");
Route::get('cart', 'FoodController@cart');

// Payments
Route::post('payments', 'FoodController@reqTotal');
Route::get('checkout', 'FoodController@checkout');
Route::post('payments/process', 'FoodController@payProcess');

// Admin Routes
Route::get('dashboard', 'AdminController@index');
Route::get('dashboard/admin/editPass/{id}', 'AdminController@editPass');
Route::get('dashboard/payment', 'AdminController@payment');
Route::get('dashboard/payment/success', 'AdminController@indexSuccess');
Route::delete('dashboard/payment/{id}', 'AdminController@updateTrans');
Route::get('dashboard/payment/{id}', 'AdminController@detailTrans');
Route::patch('dashboard/admin/editPass/{id}', 'AdminController@updatePass');
Route::get('dashboard/admin/editProfile/{id}', 'AdminController@editProfile');
Route::patch('dashboard/admin/editProfile/{id}', 'AdminController@updateProfile');

// PDf 

Route::post('pdf/stream/{id}', 'PDFController@streamPDF');
Route::get('pdf/download/{id}', 'PDFController@downloadPDF');

// Food Control
Route::get('dashboard/index', 'DashboardController@index');
Route::get('dashboard/tambah', function () {
    if (!\Session::get('login')) {
        return redirect('/login')->with('alert', 'Kamu Harus login dulu');
    } else {
        return view('dashboard.tambah');
    }
});
Route::post('dashboard/tambah', 'DashboardController@store');
Route::get('dashboard/edit/{food}', 'DashboardController@edit');
Route::patch('dashboard/edit/{food}', 'DashboardController@update');
Route::delete('dashboard/delete/{id}', 'DashboardController@destroy');
