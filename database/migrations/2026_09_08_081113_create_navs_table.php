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
        Schema::create('navs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_struktural_id')->constrained('jabatan_strukturals')->onDelete('cascade');
            $table->string('Nama')->nullable();
            $table->string('Controller')->nullable();
            $table->string('Method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navs');
    }
};
