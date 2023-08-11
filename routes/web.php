<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/', [UsersController::class, 'showRegisterView']);

// Route::get('/register', [UsersController::class, 'showRegistrationForm']);
// Route::get('/register?action=register', [UsersController::class, 'registerDB']);


// Route::get('/home', function(){
//     return view('home');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
