<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            // Estado del análisis (para pipeline async en el futuro)
            $table->string('analysis_status', 20)->nullable()->after('analysis_opt_in'); 
            // valores típicos: queued | processing | done | error

            // Resultado "principal" (lo que usarás para tendencias / positiveRate)
            $table->string('sentiment_label', 20)->nullable()->after('analysis_status');
            // ej: positive | neutral | negative

            $table->decimal('sentiment_score', 6, 4)->nullable()->after('sentiment_label');
            // score/prob principal (ej 0.0000 - 1.0000)

            // Información completa del modelo (probabilidades, logits, etc.)
            $table->json('sentiment_meta')->nullable()->after('sentiment_score');

            // Flag simple para banner de crisis (reglas simples)
            $table->boolean('crisis_flag')->default(false)->after('sentiment_meta');

            // Trazabilidad
            $table->timestamp('analyzed_at')->nullable()->after('crisis_flag');
            $table->string('model_version', 50)->nullable()->after('analyzed_at');
        });
    }

    public function down(): void
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            $table->dropColumn([
                'analysis_status',
                'sentiment_label',
                'sentiment_score',
                'sentiment_meta',
                'crisis_flag',
                'analyzed_at',
                'model_version',
            ]);
        });
    }
};
