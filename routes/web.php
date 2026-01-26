<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test_post_registro');
});

// Rutas de autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/registro', function () {
    return view('auth.registro');
})->name('registro');

Route::post('/registro', [App\Http\Controllers\AuthController::class, 'register'])->name('registro.post');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

Route::get('/test_bienestar', function () {
    return view('test_bienestar');
})->name('test.bienestar');

Route::get('/test_depresion', function () {
    return view('test_depresion');
});

Route::get('/test_ansiedad', function () {
    return view('test_ansiedad');
});

Route::get('/listado_psiquiatras', function () {
    return view('listado_psiquiatras');
});

Route::get('/dashboard_paciente', function () {
    return view('dashboard_paciente');
});
