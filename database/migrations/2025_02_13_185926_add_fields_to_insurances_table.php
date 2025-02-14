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
        Schema::table('insurances', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->unique()->after('id');
            $table->string('insurance_company')->after('vehicle_id');
            $table->date('expiration_date')->after('insurance_company');

            // Definir la clave foránea con ON DELETE CASCADE
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurances', function (Blueprint $table) {
             $table->dropForeign(['vehicle_id']);
            $table->dropColumn(['vehicle_id', 'insurance_company', 'expiration_date']);
        
       });
    }
};
