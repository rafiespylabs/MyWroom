<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tbl_attendances extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $createdAtColumn = 'createdAt';
    protected $updatedAtColumn = 'updatedAt';
    public function staff()
    {
        return $this->belongsTo(User::class, 'login_id','id');
    }
    public function added_user()
    {
        return $this->belongsTo(User::class, 'added_by','id');
    }
}
