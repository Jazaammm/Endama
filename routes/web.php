<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Google\Service\Classroom\StudentContext;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

//STUDENT
Route::get('/verify-student', [StudentController::class,'verify'])->name('verify.student');
Route::post('/verify', [StudentController::class, 'verification'])->name('verification');

Route::get('/register', [StudentController::class,'registrationform'])->name('register');
Route::post('/register', [StudentController::class, 'register'])->name('postregister');

Route::get('login', [StudentController::class, 'showlogin'])->name('login');
//Route::post('/login', [StudentController::class, 'login'])->name('postlogin');

Route::middleware(['auth:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'StudentDashboard'])->name('student.dashboard');
});

Route::post('/login', [AuthController::class, 'login'])->name('authLogin');



//ADMIN
//Route::post('/login', [UserController::class, 'login'])->name('postlogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'AdminDashboard'])->name('admin.dashboard');
});
