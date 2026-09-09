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
        Schema::create('penempatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->String('Status')->nullable();
            $table->String('Ikatan_Kerja')->nullable();
            $table->String('Jenjang_Pendidikan')->nullable();
            $table->String('Perguruan_Tinggi')->nullable();
            $table->String('Unit')->nullable();
            $table->String('Taggal_Mulai')->nullable();
            $table->String('Taggal_Surat_Terbit')->nullable();
            $table->String('Penugasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatans');
    }
};
