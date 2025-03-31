<?php

use App\Http\Controllers\StudentController;
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
    return view('auth.student.verify');
});

//STUDENT
Route::get('/verify-student', [StudentController::class,'verify'])->name('verify.student');
Route::post('/verify', [StudentController::class, 'verification'])->name('verification');

Route::get('/register', [StudentController::class,'registrationform'])->name('register');
Route::post('/register', [StudentController::class, 'register'])->name('postregister');
