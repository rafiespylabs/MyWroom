<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_state extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Tbl_country::class, 'country_id','id');
    }

}
