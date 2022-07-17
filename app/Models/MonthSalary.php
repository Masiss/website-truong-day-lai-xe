<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthSalary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ins_id',
        'month',
        'total_lessons',
        'total_hours',
        'total_salaries',
        'status,'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class,'ins_id','id');
    }
}
