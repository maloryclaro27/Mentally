<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test_post_registro');
});

Route::get('/test_bienestar', function () {
    return view('test_bienestar');
})->name('test.bienestar');

// Auth (guest)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/registro', function () {
    return view('auth.registro');
})->name('registro');

Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Protegidas
Route::middleware('auth')->group(function () {
    Route::get('/test_depresion', function () {
        return view('test_depresion');
    })->name('test.depresion');

    Route::get('/test_ansiedad', function () {
        return view('test_ansiedad');
    })->name('test.ansiedad');

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
