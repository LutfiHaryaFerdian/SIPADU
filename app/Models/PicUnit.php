namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PicUnit extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pic_units';
    protected $fillable = ['nama_unit', 'nama_pic', 'email', 'password'];

    public function penugasan() {
        return $this->hasMany(Penugasan::class, 'id_pic');
    }

    public function tindakLanjut() {
        return $this->hasMany(TindakLanjut::class, 'id_pic');
    }
}
