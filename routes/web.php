<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\PollController;
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

Route::get('/student/profile', [StudentController::class, 'StudentProfile'])->name('student.profile');
Route::put('/student/photo', [StudentController::class, 'StudentUpdatePhoto'])->name('student.updatePhoto');

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
    Route::get('/admin/settings', [UserController::class, 'adminchangepasswordform'])->name('accsettings');
    Route::put('/admin/settings/change-pass', [UserController::class, 'adminchangepassword'])->name('admin.changepass');


});

Route::get('professor-list', [UserController::class,'professorlist'])->name('proflist');

Route::get('Add-New-Prof', [UserController::class,'AddProfForm'])->name('addprof');
Route::post('New-Prof' , [UserController::class,'store'])->name('storeprof');
Route::get('/admin/professor/{id}/edit', [UserController::class, 'edit'])->name('editprof');
Route::put('/admin/professor/{id}', [UserController::class, 'update'])->name('updateprof');
Route::delete('/professor/{id}', [UserController::class, 'delete'])->name('deleteprofessor');

Route::get('/admin/students', [UserController::class, 'studentlist'])->name('studentlist');
Route::get('/admin/student/{id}/edit', [UserController::class, 'editstudent'])->name('editstu');
Route::put('/admin/student/{id}', [UserController::class, 'updatestudent'])->name('updatestu');
Route::delete('/student/{id}', [UserController::class, 'deletestudent'])->name('deletestu');

//ADMIN SETTINGS
Route::get('/admin/profile', [UserController::class, 'AdminProfile'])->name('adminprofile');
Route::put('/admin/photo', [UserController::class, 'updatePhoto'])->name('admin.updatePhoto');
Route::get('/admin/profile', [UserController::class, 'AdminProfile'])->name('adminprofile');






//PROFESSOR
Route::middleware(['auth:professor'])->group(function () {
    Route::get('/professor/dashboard', [ProfessorController::class, 'ProfessorDashboard'])->name('prof.dashboard');
    Route::get('/professor/settings', [ProfessorController::class, 'profchangepassform'])->name('prof.settings');
    Route::put('/professor/settings/change-pass', [ProfessorController::class, 'profchangepass'])->name('prof.changepass');

});

//PROF SETTINGS
Route::get('/professor/profile', [ProfessorController::class, 'ProfessorProfile'])->name('prof.profile');
Route::put('/professor/photo', [ProfessorController::class, 'ProfupdatePhoto'])->name('prof.updatePhoto');

//PROF-STUDENTS-LIST
Route::get('/professor/students-list', [ProfessorController::class, 'viewstudentlist'])->name('viewstudentlist');

//POLL
Route::get('/professor/planned-poll', [ProfessorController::class, 'plannedpoll'])->name('plannedpoll');
Route::get('/professor/ongoing-poll', [ProfessorController::class, 'ongoingpoll'])->name('poll.ongoing');
Route::get('/professor/completed-poll', [ProfessorController::class, 'completedpoll'])->name('poll.completed');

Route::get('/professor/create-poll', [PollController::class, 'createpollform'])->name('poll.createform');
Route::post('/professor/store-poll', [PollController::class, 'storepoll'])->name('poll.store');
Route::get('/polls/{poll}', [PollController::class, 'showpoll'])->name('poll.show');
Route::get('/professor/{id}/edit-poll', [PollController::class, 'editpoll'])->name('edit.poll');
Route::put('/professor/{id}/update-poll', [PollController::class, 'updatepoll'])->name('update.poll');

Route::post('/polls/{id}/status', [PollController::class, 'updateStatus'])->name('poll.updateStatus');



