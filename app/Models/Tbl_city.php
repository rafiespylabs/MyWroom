<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_city extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Tbl_country::class, 'country_id','id');
    }

    public function state()
    {
        return $this->belongsTo(Tbl_state::class, 'state_id','id');
    }

    public function district()
    {
        return $this->belongsTo(Tbl_district::class, 'district_id','id');
    }
}
