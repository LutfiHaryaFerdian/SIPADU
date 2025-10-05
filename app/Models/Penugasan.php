namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penugasan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penugasan';
    protected $fillable = ['id_admin', 'id_pic', 'id_aduan', 'catatan'];

    public function admin() {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function picUnit() {
        return $this->belongsTo(PicUnit::class, 'id_pic');
    }

    public function aduan() {
        return $this->belongsTo(Aduan::class, 'id_aduan');
    }
}
