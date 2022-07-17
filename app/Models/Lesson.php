<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'driver_id',
        'ins_id',
        'last',
        'start_at',
        'date',
        'report',
        'rating',
        'status',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'ins_id', 'id');

    }

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

}
