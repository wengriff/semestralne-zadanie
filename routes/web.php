<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;

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

// Route::get('/', function () { 
//     return view('welcome');
// });

Route::get('/', [Controller::class, 'index']);

// Log Out User 
Route::post('/logout', [AuthController::class, 'logout']);

// Show Login Form
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Login User
Route::post('/users/authenticate', [AuthController::class, 'authenticate']);

// Create User
Route::post('/users', [AuthController::class, 'store']);

// Show Register Form
Route::get('/register', [AuthController::class, 'create']);

//TEACHER

//Table of students
/*Route::get('/students', [TeacherController::class, 'students'])
->name('students')
->middleware('check.role:teacher');*/

//detailed table about students
Route::get('/students/{id}/details', [TeacherController::class, 'studentDetails'])
->name('student_details')
->middleware('check.role:teacher');

Route::middleware(['auth', 'check.role:teacher'])->group(function () {
    // Teacher-specific routes, e.g.
    Route::get('/students', [TeacherController::class, 'students'])->name('students');
});

