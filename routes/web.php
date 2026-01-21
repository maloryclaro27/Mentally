<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/test', function () {
    return view('test_post_registro');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/test_bienestar', function () {
    return view('test_bienestar');
});

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
