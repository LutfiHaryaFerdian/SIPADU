<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('foto_profile')->nullable();   // URL Cloudinary
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('prodi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn([
                'foto_profile',
                'no_hp',
                'alamat',
                'angkatan',
                'prodi'
            ]);
        });
    }

};
