<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diary_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->longText('entry_text'); // se cifrará vía cast en el modelo
            $table->string('mood', 50);
            $table->unsignedInteger('word_count')->default(0);

            $table->boolean('analysis_opt_in')->default(false);

            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diary_entries');
    }

};
