<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakLanjutTable extends Migration
{
    public function up(): void
    {
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_aduan');
            $table->uuid('id_pic');
            $table->text('catatan');
            $table->enum('status', ['Sedang Dikerjakan', 'Selesai']);
            $table->timestamps();

            $table->foreign('id_aduan')->references('id')->on('aduan')->onDelete('cascade');
            $table->foreign('id_pic')->references('id')->on('pic_units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
}
