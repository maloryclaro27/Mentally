<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('role');
            $table->date('birthdate')->nullable()->after('avatar');
            $table->string('emergency_name')->nullable()->after('birthdate');
            $table->string('emergency_phone')->nullable()->after('emergency_name');
            $table->string('emergency_relation')->nullable()->after('emergency_phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'birthdate',
                'emergency_name',
                'emergency_phone',
                'emergency_relation',
            ]);
        });
    }
};