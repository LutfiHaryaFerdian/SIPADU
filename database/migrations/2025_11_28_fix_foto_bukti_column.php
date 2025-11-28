<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            // Ubah foto_bukti dari string ke longtext untuk menampung JSON array
            $table->longText('foto_bukti')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            $table->string('foto_bukti')->nullable()->change();
        });
    }
};
