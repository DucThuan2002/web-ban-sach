<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Admin\User\AdminMainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuCustomerController;
use App\Http\Controllers\ProductCustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CartAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\User\UserController;

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
// <---------------------------------Admin------------------------->
Route::get('/admin/user/login', [LoginController::class, 'index'])->name("login");
Route::post('/admin/users/login/store', [LoginController::class, 'store']);

// login google
Route::get('/login-google', [LoginController::class, 'login_google']);
Route::get('/admin/user/login/google/callback', [LoginController::class, 'callback_google']);

// logout
Route::get('/logout', [LoginController::class, 'getLogout']);

// Authentication roles
Route::get('/admin/register-auth', [AuthController::class, 'register_auth']);
Route::post('/admin/register', [AuthController::class, 'register']);

// đã đăng nhập
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminMainController::class, 'index']);
        Route::get('/admin/main', [AdminMainController::class, 'index'])->name('admin');
        // Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::post('destroy', [MenuController::class, 'destroy']);
        });

        // Product
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::post('destroy', [ProductController::class, 'destroy']);
        });

        // Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        // Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::post('destroy', [SliderController::class, 'destroy']);
        });

        // Cart
        Route::get('customers', [CartAdminController::class, 'index']);
        Route::get('customer/view/{customer}', [CartAdminController::class, 'show']);

        // User authentication
        Route::get('users', [UserController::class, 'index']);
        Route::post('assign-roles', [UserController::class, 'assign_roles']);
        
    });

});

// // <---------------------------------USER------------------------->
Route::get('/', [MainController::class, 'index']);
// Menu
Route::post('/services/load-products', [MainController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html', [MenuCustomerController::class, 'index']);
// Product
Route::get('san-pham/{id}-{slug}.html', [ProductCustomerController::class, 'index']);
// Cart
Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);
Route::post('/admin/customers', [CartController::class, 'addCart']);


