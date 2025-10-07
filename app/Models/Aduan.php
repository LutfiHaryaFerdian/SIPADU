<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Aduan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'aduan';
    protected $fillable = [
        'id_mahasiswa', 'judul', 'deskripsi', 'kategori', 'status', 'nomor_tiket'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function penugasan() {
        return $this->hasMany(Penugasan::class, 'id_aduan');
    }

    public function tindakLanjut() {
        return $this->hasMany(TindakLanjut::class, 'id_aduan');
    }
}
