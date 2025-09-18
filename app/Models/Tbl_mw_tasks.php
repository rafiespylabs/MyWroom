<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_tasks extends Model
{
    use HasFactory;

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'addedby', 'id');
    }

    public function editedByUser()
    {
        return $this->belongsTo(User::class, 'editedby', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Tbl_departments::class, 'dep_id','id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
