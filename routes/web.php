<?php

use Illuminate\Support\Facades\Route;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/solicitarcita/createweb', [App\Http\Controllers\AppointmentController::class, 'solicitar']);
Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'hours']);
Route::post('/reservarcita', [App\Http\Controllers\AppointmentController::class, 'storeweb']);
  
Route::get('/email',function(){
    //return (new Notificacion("Milagros"));
    $response = Mail::to('mruiz.oporta@gmail.com')->send(new Notificacion("Milagros"));
    drump($response);
});
    

//Rutas Especialidades
    Route::get('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'index']);
    Route::get('/especialidades/{specialty}/medicos', [App\Http\Controllers\Api\SpecialtyController::class, 'doctors']);
   
    Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/especialidades/create', [App\Http\Controllers\admin\SpecialtyController::class, 'create']);
    Route::get('/especialidades/{specialty}/edit', [App\Http\Controllers\admin\SpecialtyController::class, 'edit']);
    Route::post('/especialidades', [App\Http\Controllers\admin\SpecialtyController::class, 'sendData']);
    Route::put('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'update']);
    Route::delete('/especialidades/{specialty}', [App\Http\Controllers\admin\SpecialtyController::class, 'destroy']);
    
    //Rutas Medicos
    Route::resource('medicos','App\Http\Controllers\admin\DoctorController'); 
    
    //Rutas Pacientes
    Route::resource('pacientes','App\Http\Controllers\admin\PacienteController'); 

    //Rutas Reportes
    Route::get('/reportes/citas/line', [App\Http\Controllers\admin\ChartController::class, 'appointments']);
    Route::get('/reportes/doctors/column', [App\Http\Controllers\admin\ChartController::class, 'doctors']);
    Route::get('/reportes/doctors/column/data', [App\Http\Controllers\admin\ChartController::class, 'doctorsJson']);
    
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'store']);
    
});    

Route::middleware('auth')->group(function()
{
    Route::get('/reservarcitas/create', [App\Http\Controllers\AppointmentController::class, 'create']);
    Route::post('/reservarcita', [App\Http\Controllers\AppointmentController::class, 'store']);
    
    Route::get('/miscitas', [App\Http\Controllers\AppointmentController::class, 'index']);
    Route::post('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel']);
    Route::get('/miscitas/{appointment}/cancel', [App\Http\Controllers\AppointmentController::class, 'formcancel']);
    Route::get('/miscitas/{appointment}', [App\Http\Controllers\AppointmentController::class, 'show']);
    Route::post('/miscitas/{appointment}/confirm', [App\Http\Controllers\AppointmentController::class, 'confirm']);
});


