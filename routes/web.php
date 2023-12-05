<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
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
    return view('home');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/getUserData', [UserController::class, 'getUserData']);
});

Route::group([], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/signUp', [AuthController::class, 'signUp']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/signIn', [AuthController::class, 'signIn'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/editUser', [UserController::class, 'edit']);
    Route::post('/updateUser/{userId}', [UserController::class, 'update']);
    Route::get('/editPassword', [UserController::class, 'editPassword']);
    Route::post('/updatePassword', [UserController::class, 'updatePassword']);
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/assignInsurance/{userId}', [PatientController::class, 'assignInsurance']);
    Route::post('/addInsurance/{userId}', [PatientController::class, 'addInsurance']);
    Route::get('/editInsurance/{userId}', [PatientController::class, 'editInsurance']);
    Route::post('/updateInsurancePlan/{userId}', [PatientController::class, 'updateInsurance']);
    Route::get('/deleteInsurance/{userId}', [PatientController::class, 'deleteInsurance']);
    Route::get('/myAppointments/patient', [PatientController::class, 'appointmentsForPatient']);
    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/addDoctor', [DoctorController::class, 'create']);
    Route::post('/addDoctor/{userId}', [DoctorController::class, 'add']);
    Route::get('/editDoctor/{userId}', [DoctorController::class, 'edit']);
    Route::post('/updateDoctor/{userId}', [DoctorController::class, 'update']);
    Route::get('/deleteDoctor/{userId}', [DoctorController::class, 'delete']);
    Route::get('/myAppointments/doctor', [DoctorController::class, 'appointmentsForDoctor']);
    Route::get('/insurances', [InsuranceController::class, 'index'])->name('insurances');
    Route::get('/addInsurance', [InsuranceController::class, 'create']);
    Route::post('/addInsurance', [InsuranceController::class, 'add']);
    Route::get('/editInsurance/{id}', [InsuranceController::class, 'edit']);
    Route::post('/updateInsurance/{id}', [InsuranceController::class, 'update']);
    Route::get('/appoinment', [AppointmentController::class, 'create']);
    Route::post('/getAppointment/{userId}', [AppointmentController::class, 'add']);
});
