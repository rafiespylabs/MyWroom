<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_invoices extends Model
{
    use HasFactory;
    public function added_user()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
    public function chapter()
    {
        return $this->belongsTo(Tbl_chapter::class, 'chapter_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Tbl_membership::class, 'member_id', 'id');
    }
}
