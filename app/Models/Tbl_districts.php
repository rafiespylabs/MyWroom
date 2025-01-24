<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tbl_districts extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $createdAtColumn = 'createdAt';
    protected $updatedAtColumn = 'updatedAt';
    public function country()
    {
        return $this->belongsTo(Tbl_countries::class, 'country_id','id');
    }
    public function state()
    {
        return $this->belongsTo(Tbl_states::class, 'state_id','id');
    }
}
