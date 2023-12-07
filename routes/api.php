<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CommentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [AuthController::class, 'login'])->middleware('throttle:3');
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::get('user', [AuthController::class, 'user'])->middleware("auth:sanctum");


Route::get('notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');

Route::apiResources([
   'users' => UserController::class,
   'posts' => PostController::class,
   'photos' => PhotoController::class,
   'products' => ProductController::class,
   'comments' => CommentController::class,
   'categories' => CategoryController::class,
   'notifications' => NotificationController::class,
   'categories.products' => CategoryProductController::class,
]);

