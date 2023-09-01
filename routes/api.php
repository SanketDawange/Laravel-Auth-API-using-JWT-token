<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;

Route::group(['middleware' => 'api'], function ($routes) {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/get-patient-details', [PatientController::class, 'getPatient']);
    Route::post('/update-patient-details', [PatientController::class, 'updatePatient']);

});
