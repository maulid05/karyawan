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
        Schema::create('profil_akademiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->String('Rumpun_Ilmu')->nullable();
            $table->String('Pohon_Ilmu')->nullable();
            $table->String('Kelompok_Ilmu')->nullable();
            $table->String('Cabang_Ilmu')->nullable();
            $table->String('Scopus_Id')->nullable();
            $table->String('Scopus_Link')->nullable();
            $table->String('Scopus_H_Index')->nullable();
            $table->String('Google_Scholar_Id')->nullable();
            $table->String('Google_Scholar_Link')->nullable();
            $table->String('Google_Scholar_H_Index')->nullable();
            $table->String('Orchid_Id')->nullable();
            $table->String('Orchid_Link')->nullable();
            $table->String('Repository_Universitas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_akademiks');
    }
};
