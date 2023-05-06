<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// *** Resource Routes *** !!!
// Common Resource Routes:
// index - Show all items
// show - Show single item
// create - Show form to create new item
// store - Store new item
// edit - Show form to edit item
// update - Update item
// destroy - Delete item  

Route::get('/', function () {
    return view('welcome');
});

// Log Out User 
Route::post('/logout', [AuthController::class, 'logout']);

// Show Login Form
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Login User
Route::get('/auth/authenticate', [AuthController::class, 'authenticate']);

// Create User
Route::post('/users', [AuthController::class, 'store']);

// Show Register Form
Route::get('/register', [AuthController::class, 'create']);