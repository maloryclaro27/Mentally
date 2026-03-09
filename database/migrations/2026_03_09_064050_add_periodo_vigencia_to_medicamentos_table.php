<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->date('fecha_inicio')->nullable()->after('activo');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
        });

        DB::table('medicamentos')
            ->whereNull('fecha_inicio')
            ->update([
                'fecha_inicio' => DB::raw('DATE(created_at)')
            ]);

        DB::table('medicamentos')
            ->where('activo', true)
            ->update([
                'fecha_fin' => null
            ]);
    }

    public function down(): void
    {
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicio', 'fecha_fin']);
        });
    }
};