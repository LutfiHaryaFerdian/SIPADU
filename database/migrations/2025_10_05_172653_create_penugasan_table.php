<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanTable extends Migration
{
    public function up(): void
    {
        Schema::create('penugasan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_admin');
            $table->uuid('id_pic');
            $table->uuid('id_aduan');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('admin')->onDelete('cascade');
            $table->foreign('id_pic')->references('id')->on('pic_units')->onDelete('cascade');
            $table->foreign('id_aduan')->references('id')->on('aduan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penugasan');
    }
}
