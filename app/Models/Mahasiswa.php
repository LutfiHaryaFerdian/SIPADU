<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
// Tambahkan import ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Ubah 'extends Model' menjadi 'extends Authenticatable'
class Mahasiswa extends Authenticatable
{
    // Tambahkan trait Notifiable dan HasApiTokens
    use HasFactory, HasUuids, Notifiable, HasApiTokens;

    protected $table = 'mahasiswa';
    protected $fillable = ['nama', 'npm', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function aduan() {
        return $this->hasMany(Aduan::class, 'id_mahasiswa');
    }
}

