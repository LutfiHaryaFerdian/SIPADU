namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TindakLanjut extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tindak_lanjut';
    protected $fillable = ['id_aduan', 'id_pic', 'catatan', 'status'];

    public function aduan() {
        return $this->belongsTo(Aduan::class, 'id_aduan');
    }

    public function picUnit() {
        return $this->belongsTo(PicUnit::class, 'id_pic');
    }
}
