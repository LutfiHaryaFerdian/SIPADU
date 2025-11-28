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
        Schema::table('aduan', function (Blueprint $table) {
            // Status validasi: Valid, Tidak Valid, atau NULL (belum divalidasi)
            $table->enum('status_validasi', ['Valid', 'Tidak Valid'])->nullable()->after('status');
            // Catatan admin untuk penjelasan validasi
            $table->text('catatan_admin')->nullable()->after('status_validasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aduan', function (Blueprint $table) {
            $table->dropColumn(['status_validasi', 'catatan_admin']);
        });
    }
};
