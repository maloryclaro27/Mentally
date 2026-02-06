<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('test_type'); // wellbeing | depression | anxiety
            $table->unsignedInteger('score')->nullable();
            $table->string('result')->nullable(); // leve/moderado/severo, etc.
            $table->json('answers')->nullable();  // opcional: respuestas

            $table->timestamp('taken_at')->useCurrent();

            $table->timestamps();

            $table->index(['user_id', 'test_type', 'taken_at']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_attempts');
    }
};
