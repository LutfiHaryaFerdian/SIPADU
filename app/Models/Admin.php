<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Admin extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'admin';
    protected $fillable = ['nama', 'email', 'password'];

    public function penugasan() {
        return $this->hasMany(Penugasan::class, 'id_admin');
    }
}
