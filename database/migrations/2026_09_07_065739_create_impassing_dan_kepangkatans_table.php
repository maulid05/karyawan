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
        Schema::create('impassing_dan_kepangkatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->String('Pangkat_atau_Golongan')->nullable();
            $table->String('No_SK')->nullable();
            $table->String('Tanggal_SK')->nullable();
            $table->String('Tanggal_Mulai')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impassing_dan_kepangkatans');
    }
};
