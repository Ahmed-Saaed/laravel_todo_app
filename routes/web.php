<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\todoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', userController::class);
Route::resource('todo', todoController::class)->middleware('userAuth');

//auth
Route::get('login', [userController::class, 'Login']);
Route::post('DoLogin', [userController::class, 'DoLogin']);
Route::get('logout', [userController::class, 'logout'])->middleware('userAuth');






/*
   /Blog           (get)    =    Route::get('Blog',[blogController::class, 'index']);
   /Blog/create    (get)    =    Route::get('Blog/create',[blogController::class, 'create']);
   /Blog           (post)   =    Route::post('Blog',[blogController::class, 'store']);
   /Blog/{id}/edit (get)    =    Route::get('Blog/{id}/edit',[blogController::class, 'edit']);
   /Blog/{id}      (put)    =    Route::put('Blog/{id}',[blogController::class, 'update']);
   /Blog/{id}      (delete) =    Route::delete('Blog/{id}',[blogController::class, 'destroy']);
   /Blog/{id}      (get)    =    Route::get('Blog/{id}',[blogController::class, 'show']);
*/
