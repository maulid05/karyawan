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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->String('Email')->nullable();
            $table->String('Alamat')->nullable();
            $table->String('RT')->nullable();
            $table->String('RW')->nullable();
            $table->String('Desa_atau_Kelurahan')->nullable();
            $table->String('Kecamatan')->nullable();
            $table->String('Kabupaten_atau_Kota')->nullable();
            $table->String('Provinsi')->nullable();
            $table->String('Kode_Pos')->nullable();
            $table->String('No_Telepon_Rumah')->nullable();
            $table->String('No_Handphone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
