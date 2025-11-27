<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            // Tambah kolom foto_ktm dan foto_bukti jika belum ada
            if (!Schema::hasColumn('aduan', 'foto_ktm')) {
                $table->string('foto_ktm')->nullable();
            }
            if (!Schema::hasColumn('aduan', 'foto_bukti')) {
                $table->string('foto_bukti')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            $table->dropColumn(['foto_ktm', 'foto_bukti']);
        });
    }
};
