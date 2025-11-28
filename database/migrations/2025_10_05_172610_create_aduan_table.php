<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAduanTable extends Migration
{
    public function up(): void
    {
        Schema::create('aduan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_mahasiswa');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai','Ditolak'])->default('Menunggu');
            $table->string('nomor_tiket')->unique();
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduan');
    }
}
