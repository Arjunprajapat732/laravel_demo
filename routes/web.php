<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
// use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Account\TinyOptimizer;
use App\Http\Controllers\Account\TaskController;
use App\Http\Controllers\Account\PusherController;
use App\Http\Controllers\Account\PaymentController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\DropzoneController;
use App\Http\Controllers\Account\TypeheadController;
use App\Http\Controllers\Account\DatatableController;
use App\Http\Controllers\Account\InterventionController;
use App\Http\Controllers\Account\TablepaginationController;

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

// Route::get('/home', [DashboardController::class, 'h_one']);
// Route::post('note/store' , [TaskController::class, 'notestore']);
// Route::post('/signup_user', [LoginController::class, 'signup_user']);



Route::group(['prefix' => '/', 'as' => '/.'], function() {
	Route::get('', function () {return view('welcome');});
	Route::get('register', [LoginController::class, 'register'])->name('register');
	Route::post('register_store', [LoginController::class, 'register_store'])->name('register_store');
	Route::get('login', [LoginController::class, 'login']);
	Route::post('login_user', [LoginController::class, 'login_user']);
});

Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
	Route::get('dashboard', [AccountController::class, 'dashboard']);
	Route::get('dashboard/index', [AccountController::class, 'index']);
	Route::get('table_pagination/index', [TablepaginationController::class, 'index']);
	Route::get('datatable/index', [DatatableController::class, 'index']);
	
	Route::get('dropzone/index' , [DropzoneController::class, 'index']);

	Route::group(['prefix' => 'task', 'as' => 'task.'], function() {
		Route::get('index', [TaskController::class, 'index']);
		Route::get('edit', [TaskController::class, 'edit']);
		Route::post('store', [TaskController::class, 'store']);
	});

	Route::group(['prefix' => 'payment', 'as' => 'payment.'], function() {
		Route::get('index', [PaymentController::class, 'index']);
		Route::get('payment_form', [PaymentController::class, 'payment_form']);

		Route::group(['prefix' => 'googlepay', 'as' => 'googlepay.'], function() {
			Route::get('/checkout', [PaymentController::class, 'checkout']);
			Route::post('/payment', [PaymentController::class, 'payment']);  
		});

		Route::post('/process-payment', [PaymentController::class, 'processpayment_square'])->name('process.payment');
	});

	Route::group(['prefix' => 'pusher', 'as' => 'pusher.'], function() {
		Route::get('index', [PusherController::class, 'index']);
		Route::get('messages', [PusherController::class, 'fetchMessages']);
		Route::post('messages', [PusherController::class, 'sendMessage']);
		Route::get('/payment', [PusherController::class, 'payment']); 
	});

	Route::group(['prefix' => 'tiny_optimizer', 'as' => 'tiny_optimizer.'], function() {
		Route::get('index', [TinyOptimizer::class, 'index']);
		Route::post('store', [TinyOptimizer::class, 'store']);
	});

	Route::group(['prefix' => 'intervention_image', 'as' => 'intervention_image.'], function() {
		Route::get('index', [InterventionController::class, 'index']);
		Route::post('store', [InterventionController::class, 'store']);
	});

	Route::get('type_head_js/index', [TypeheadController::class, 'index']);
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', function() {
		return redirect('account/dashboard/project');
	});
});