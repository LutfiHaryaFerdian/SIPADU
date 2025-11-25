<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            if (!Schema::hasColumn('tindak_lanjut', 'catatan_selesai')) {
                $table->text('catatan_selesai')->nullable()->after('catatan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tindak_lanjut', function (Blueprint $table) {
            if (Schema::hasColumn('tindak_lanjut', 'catatan_selesai')) {
                $table->dropColumn('catatan_selesai');
            }
        });
    }
};
