<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('especialista_paciente', function (Blueprint $table) {
            $table->id();

            $table->foreignId('especialista_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('paciente_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('estado')->default('pendiente');
            $table->string('codigo_vinculacion')->nullable();
            $table->boolean('consentimiento_aceptado')->default(false);
            $table->timestamp('consentimiento_aceptado_en')->nullable();

            $table->timestamps();

            $table->unique(['especialista_id', 'paciente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especialista_paciente');
    }
};
