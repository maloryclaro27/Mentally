<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Primero verificamos si los campos ya existen para evitar errores
        if (!Schema::hasColumn('users', 'first_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('first_name')->after('id')->nullable();
            });
        }
        
        if (!Schema::hasColumn('users', 'last_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('last_name')->after('first_name')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Opcional: remover los campos si quieres revertir
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn(['first_name', 'last_name']);
        // });
    }
};