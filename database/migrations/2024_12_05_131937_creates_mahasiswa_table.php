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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nama'); // Name of the student
            $table->string('nim')->unique(); // Student ID (NIM), should be unique
            $table->string('email')->unique(); // Email address, should be unique
            $table->string('jurusan'); // Department or course of study
            $table->integer('tahun_masuk'); // Year of entry
            $table->timestamps(); // Created at & Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
