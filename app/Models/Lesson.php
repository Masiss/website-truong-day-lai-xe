<?php

namespace App\Models;

use App\Enums\LessonStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => LessonStatusEnum::StatusInVNese($value),
        );
    }

    protected function report(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? $value : "<Trống>",
        );
    }

    protected function last(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value." tiếng",
        );
    }

    protected function startAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value." giờ",
        );
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d/m/Y', strtotime($value)),
        );
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'ins_id', 'id');

    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }


}
