<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignmentController;

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

Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');

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
//detailed table about students
Route::middleware(['auth', 'check.role:teacher'])->group(function () {
    Route::get('/students/{id}/details', [TeacherController::class, 'studentDetails'])
    ->name('student_details');
});

//info about students
Route::middleware(['auth', 'check.role:teacher'])->group(function () {
    Route::get('/students', [TeacherController::class, 'students'])
    ->name('students');
});

//teacher edit assingment and save
Route::get('/assignment/{id}/edit', [AssignmentController::class, 'edit'])->name('assignment.edit');
Route::put('/assignment/{id}', [AssignmentController::class, 'update'])->name('assignment.update');
Route::get('/assignment/{id}', [AssignmentController::class, 'show'])->name('assignment.show');

//STUDENT
//generate problem update webpage
Route::post('/assignments/update-status', [AssignmentController::class, 'updateStatus']);
//solve problem
Route::get('/solve-problem/{problemId}', [AssignmentController::class, 'solve'])->name('solve-problem');
Route::post('/submit', [AssignmentController::class, 'store'])->name('submit.solution');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('/export-csv', 'App\Http\Controllers\ExportController@export')->name('export.csv');

