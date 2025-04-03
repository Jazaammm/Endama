<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessorController;
use App\Models\Professor;
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class,'forgotpassword'])->name('forgotpasswordForm');
Route::post('/forgot-password', [AuthController::class,'forgotPasswordPost'])->name('forgotpasswordPost');

Route::get('reset-password/{token}', [AuthController::class,'resetPasswordForm'])->name('resetpasswordForm');
Route::post('reset-password', [AuthController::class,'resetPassword'])->name('resetpasswordPost');





//ADMIN
//Route::post('/login', [UserController::class, 'login'])->name('postlogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'AdminDashboard'])->name('admin.dashboard');
});

Route::get('professor-list', [UserController::class,'professorlist'])->name('proflist');

Route::get('Add-New-Prof', [UserController::class,'AddProfForm'])->name('addprof');
Route::post('New-Prof' , [UserController::class,'store'])->name('storeprof');


//PROFESSOR
Route::middleware(['auth:professor'])->group(function () {
    Route::get('/professor/dashboard', [ProfessorController::class, 'ProfessorDashboard'])->name('prof.dashboard');
});
