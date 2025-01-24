<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_chapter extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(Tbl_city::class, 'city_id','id');
    }
}
