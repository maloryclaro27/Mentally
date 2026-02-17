<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestAttemptController;
use App\Models\TestAttempt;
use App\Models\User;
use App\Http\Controllers\DiaryEntryController;
use App\Http\Controllers\EspecialistaController;


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

// Registro Especialista (guest)
Route::get('/registro_especialista', [EspecialistaController::class, 'showRegisterForm'])
    ->name('registro.especialista');

Route::post('/registro_especialista', [EspecialistaController::class, 'register'])
    ->name('registro.especialista.post');


// Protegidas
Route::middleware('auth')->group(function () {
    Route::get('/test_bienestar', function () {
        return view('test_bienestar');
    })->middleware('test.cooldown:wellbeing')
        ->name('test.bienestar');

    Route::post('/test_bienestar/guardar', [TestAttemptController::class, 'store'])
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


    Route::get('/test_ansiedad', function () {
        return view('test_ansiedad');
    })->middleware('test.cooldown:anxiety')
        ->name('test.ansiedad');

    Route::post('/test_ansiedad/guardar', [TestAttemptController::class, 'store'])
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

    Route::get('/dashboard-especialista', [EspecialistaController::class, 'dashboard'])
        ->middleware('is_especialista')
        ->name('especialista.dashboard');

    Route::post('/diary-entries', [DiaryEntryController::class, 'store'])->name('diary.entries.store');

    Route::get('/diary-entries/recent', [DiaryEntryController::class, 'recent'])->name('diary.entries.recent');
    Route::get('/diary-entries/stats', [DiaryEntryController::class, 'stats'])->name('diary.entries.stats');

    Route::get('/diary-entries/mood-trend', [DiaryEntryController::class, 'moodTrend'])->name('diary.entries.moodTrend');
    Route::get('/diary-entries/mood-chart', [DiaryEntryController::class, 'moodChart'])->name('diary.entries.moodChart');

    // SIEMPRE al final las rutas con {id}
    Route::get('/diary-entries/{id}', [DiaryEntryController::class, 'show'])
        ->whereNumber('id')
        ->name('diary.entries.show');

    Route::delete('/diary-entries/{id}', [DiaryEntryController::class, 'destroy'])
        ->whereNumber('id')
        ->name('diary.entries.destroy');




    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
