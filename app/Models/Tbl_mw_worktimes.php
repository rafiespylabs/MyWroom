<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_worktimes extends Model
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
}
