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
        'total_lessons',
        'total_salary',
    ];

//    public function total_lessons()
//    {
//        return $this->hasMany()
//    }
}
