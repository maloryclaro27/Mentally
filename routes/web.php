<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestAttemptController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test_post_registro');
});

// Auth (guest)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/registro', function () {
    return view('auth.registro');
})->name('registro');

Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/registro_especialista', function () {
    return view('auth.registro_especialista');
})->name('registro.especialista.post');

// Protegidas
Route::middleware('auth')->group(function () {
    Route::post('/test_bienestar', [TestAttemptController::class, 'store'])
        ->middleware('test.cooldown:wellbeing')
        ->defaults('testType', 'wellbeing')
        ->name('test.bienestar.submit');

    Route::get('/test_depresion', function () {
        return view('test_depresion');
    })->middleware('test.cooldown:depression')
        ->name('test.depresion');

    Route::post('/test_depresion/guardar', [TestAttemptController::class, 'store'])
        ->middleware('test.cooldown:depression')
        ->defaults('testType', 'depression')
        ->name('test.depresion.submit');


    Route::post('/test_ansiedad', [TestAttemptController::class, 'store'])
        ->middleware('test.cooldown:anxiety')
        ->defaults('testType', 'anxiety')
        ->name('test.ansiedad.submit');

    Route::get('/listado_psiquiatras', function () {
        return view('listado_psiquiatras');
    })->name('psiquiatras');

    Route::get('/diario_emocional', function () {
        return view('diario_emocional');
    })->name('diario.emocional');

    Route::get('/chatbot', function () {
        return view('chatbot');
    })->name('chatbot');

    Route::get('/dashboard_paciente', function () {
        return view('dashboard_paciente');
    })->middleware('auth')->name('dashboard.paciente');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
