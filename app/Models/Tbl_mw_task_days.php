<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_task_days extends Model
{
    use HasFactory;

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function editedByUser()
    {
        return $this->belongsTo(User::class, 'edited_by', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Tbl_mw_tasks::class, 'task_id','id');
    }

    public function worktime()
    {
        return $this->belongsTo(Tbl_mw_worktimes::class, 'worktime_id','id');
    }
}
