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
        Schema::create('makul', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('kode_makul')->unique(); // Kode mata kuliah, harus unik
            $table->string('nama_makul'); // Nama mata kuliah
            $table->integer('sks'); // SKS mata kuliah
            $table->string('jurusan'); // Jurusan yang membuka mata kuliah
            $table->timestamps(); // Created at & Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makul');
    }
};
