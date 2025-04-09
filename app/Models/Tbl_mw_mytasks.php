<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_mytasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'task_status_id',
        'task_status_date',
        'worktime_id',
        'user_id',
        'addedby',
        'added_date',
    ];

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'addedby', 'id');
    }

    public function editedByUser()
    {
        return $this->belongsTo(User::class, 'editedby', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Tbl_mw_tasks::class, 'task_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Tbl_mw_statuses::class, 'task_status_id','id');
    }

    public function worktime()
    {
        return $this->belongsTo(Tbl_mw_worktimes::class, 'worktime_id','id');
    }

    public function user()
    {
        return $this->belongsTo(Tbl_staffs::class, 'user_id','id');
    }

}
