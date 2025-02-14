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
        Schema::table('vehicles', function (Blueprint $table) {
             $table->string('license_plate')->unique()->after('id');
            $table->string('brand')->after('license_plate');
            $table->string('model')->after('brand');
            $table->integer('year')->after('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['license_plate', 'brand', 'model', 'year']);
        });
    }
};
