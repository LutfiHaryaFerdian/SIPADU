<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicUnitsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pic_units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_unit');
            $table->string('nama_pic');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pic_units');
    }
}
