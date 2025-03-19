<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_mytask_trans extends Model
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

    public function user()
    {
        return $this->belongsTo(Tbl_staffs::class, 'user_id','id');
    }

    public function worktime()
    {
        return $this->belongsTo(Tbl_mw_worktimes::class, 'worktime_id','id');
    }

    public function task()
    {
        return $this->belongsTo(Tbl_mw_tasks::class, 'task_id','id');
    }

    public function mytask()
    {
        return $this->belongsTo(Tbl_mw_mytasks::class, 'mytask_id','id');
    }    

    public function chapter()
    {
        return $this->belongsTo(Tbl_chapter::class, 'chapter_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Tbl_mw_statuses::class, 'sub_task_status_id', 'id');
    }
}
