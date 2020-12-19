<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::post('/reservation', [ReservationController::class, 'reserve'])->name('reservation.reserve');
Route::post('/contact', [ContactController::class, 'contact'])->name('contact.message');

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
	// dashboard
	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	// dashboard
	// -------------------------------------------------------------------------------------
	// slider
	Route::resource('slider', SliderController::class);
	// slider
	// -------------------------------------------------------------------------------------
	// category
	Route::resource('category', CategoryController::class);
	// category
	// -------------------------------------------------------------------------------------
	// item
	Route::resource('item', ItemController::class);
	// item
	// -------------------------------------------------------------------------------------
	// About
	Route::resource('about', AboutController::class);
	// About
	// -------------------------------------------------------------------------------------
	// Reservation
	Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
	Route::get('reservation/{id}', [ReservationController::class, 'show'])->name('reservation.show');
	Route::post('reservation/{id}', [ReservationController::class, 'status'])->name('reservation.status');
	Route::post('reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
	Route::delete('reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
	// Reservation
	// -------------------------------------------------------------------------------------
	// contact
	Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
	Route::get('contact/{id}', [ContactController::class, 'show'])->name('contact.show');
	Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
	// contact
});