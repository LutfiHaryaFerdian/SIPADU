<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            // Jika kolom lama ada, hapus
            if (Schema::hasColumn('aduan', 'foto_bukti')) {
                $table->dropColumn('foto_bukti');
            }
            
            // Tambah kolom baru untuk multiple foto bukti (JSON array, max 5)
            $table->json('foto_bukti')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            if (Schema::hasColumn('aduan', 'foto_bukti')) {
                $table->dropColumn('foto_bukti');
            }
        });
    }
};
