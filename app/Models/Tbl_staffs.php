<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_staffs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $createdAtColumn = 'createdAt';
    protected $updatedAtColumn = 'updatedAt';
    public function department()
    {
        return $this->belongsTo(Tbl_departments::class, 'dept_id','id');
    }
    public function designation()
    {
        return $this->belongsTo(Tbl_designations::class, 'design_id','id');
    }
    public function branch()
    {
        return $this->belongsTo(Tbl_branches::class, 'branch_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
