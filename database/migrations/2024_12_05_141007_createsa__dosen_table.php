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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nama'); // Nama dosen
            $table->string('nip')->unique(); // NIP dosen, harus unik
            $table->string('email')->unique(); // Email dosen, harus unik
            $table->string('jurusan'); // Jurusan yang diampu dosen
            $table->text('alamat')->nullable(); // Alamat dosen (nullable)
            $table->string('telepon')->nullable(); // Nomor telepon dosen (nullable)
            $table->timestamps(); // Created at & Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
