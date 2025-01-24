<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_membership extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function business_category()
    {
        return $this->belongsTo(Tbl_business_category::class, 'business_category_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Tbl_city::class, 'city_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(Tbl_chapter::class, 'chapter_id', 'id');
    }

    public function membership_type()
    {
        return $this->belongsTo(Tbl_membership_type::class, 'membership_type_id', 'id');
    }
}
