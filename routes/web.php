<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestAttemptController;
use App\Models\TestAttempt;
use App\Models\User;
use App\Http\Controllers\DiaryEntryController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\Auth0Controller;
use App\Http\Controllers\ChequeosController;
use App\Http\Controllers\AdherenciaController;
use App\Http\Controllers\MedicationReminderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecordatorioMedicamento;
use App\Models\Medicamento;
use App\Http\Controllers\ChatbotController;
use App\Services\Chatbot\ChatProviderManager;
use App\Services\Chatbot\EmotionalResponseBuilder;
use App\Services\Chatbot\EmotionalChatbotService;
use App\Http\Controllers\DashboardPacienteController;
use App\Http\Controllers\ProfileController;



Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/test-chat-provider', function (EmotionalChatbotService $chatbot) {
    $result = $chatbot->respond([
        'message' => 'voy perdiendo una materia en la universidad',
        'emotion' => 'ansiedad',
        'topic' => 'universidad',
        'previous_messages' => [
            [
                'role' => 'user',
                'content' => 'Me siento muy ansioso hoy',
            ],
            [
                'role' => 'assistant',
                'content' => 'Gracias por decirlo. Cuando la ansiedad aparece así, el día puede sentirse más pesado. ¿Qué crees que la detonó hoy?',
            ],
        ],
    ]);

    return response()->json($result);
});

Route::get('/login/google', [Auth0Controller::class, 'loginGoogle'])->name('login.google');
Route::get('/callback', [Auth0Controller::class, 'callback'])->name('auth0.callback');
Route::get('/logout-auth0', [Auth0Controller::class, 'logout'])->name('auth0.logout');

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
// Protegidas (general: paciente y cualquiera autenticado)
Route::middleware(['auth'])->group(function () {

    // ✅ NUEVO: Resultados revisitable
    Route::get('/tests/resultados/{attempt}', [TestAttemptController::class, 'show'])
        ->name('tests.resultados.show');

    // Tests (con cooldown por tipo)
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

    Route::get('/adherencia', [App\Http\Controllers\AdherenciaController::class, 'index'])
        ->name('adherencia');

    Route::post('/adherencia/medicamentos', [AdherenciaController::class, 'guardarMedicamento'])
        ->name('adherencia.guardarMedicamento')
        ->middleware('auth');

    Route::delete('/adherencia/medicamentos/{id}', [AdherenciaController::class, 'eliminarMedicamento'])
        ->name('adherencia.eliminarMedicamento')
        ->middleware('auth');

    Route::post('/adherencia/medicamentos/{id}/marcar-toma', [AdherenciaController::class, 'marcarToma'])
        ->name('adherencia.marcarToma')
        ->middleware('auth');
    Route::put('/adherencia/medicamentos/{id}', [AdherenciaController::class, 'actualizarMedicamento'])
        ->name('adherencia.actualizarMedicamento')
        ->middleware('auth');

    Route::get('/medicamentos/confirmar-toma/{schedule}/{user}', [MedicationReminderController::class, 'confirm'])
        ->name('medications.confirm-intake')
        ->middleware('signed');
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');


    // Views protegidas (si así las quieres)
    Route::get('/listado_psiquiatras', function () {
        return view('listado_psiquiatras');
    })->name('psiquiatras');

    Route::get('/diario_emocional', function () {
        return view('diario_emocional');
    })->name('diario.emocional');

    Route::get('/dashboard_paciente', [DashboardPacienteController::class, 'index'])
        ->name('dashboard.paciente');

    Route::middleware(['auth'])->group(function () {
        Route::get('/chequeos', [ChequeosController::class, 'index'])->name('chequeos');
    });

    // Diary entries API
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

    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::match(['post', 'put'], '/perfil/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/perfil/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/perfil/emergency', [ProfileController::class, 'updateEmergency'])->name('profile.emergency');
});

// Especialista (aquí sí aplicas bloqueos y verificación)
Route::prefix('especialista')
    ->middleware(['auth', 'is_especialista', 'block_unverified_especialista'])
    ->group(function () {

        // Accesible para NO verificados (y verificados también)
        Route::get('/esperando-verificacion', [EspecialistaController::class, 'esperandoVerificacion'])
            ->name('especialista.esperando_verificacion');

        // Solo verificados (clínico real)
        Route::middleware('is_verificado')->group(function () {

            Route::get('/dashboard', [EspecialistaController::class, 'dashboard'])
                ->name('especialista.dashboard');

            // futuras rutas...
        });
    });
