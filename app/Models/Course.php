<?php

namespace App\Models;

use App\Enums\CourseTypeEnums;
use App\Enums\DaysOfWeekEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
    use Sortable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'days_of_week',
        'price',
        'price_per_day',
    ];

    public $sortable = [
        'type',
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn($value) => CourseTypeEnums::from($value)->name,
            set: fn($value) => CourseTypeEnums::from($value)->value,
        );
    }

    protected function daysOfWeek(): Attribute
    {
        return Attribute::make(
            get: fn($value) => self::FromDatabaseToString(json_decode($value)),
            set: fn($value) => json_encode($value),
        );
    }

    public static function FromDatabaseToString($array)
    {
        $array = Arr::map($array, function ($value) {
            return DaysOfWeekEnum::getValueByKey($value);
        });
        return implode(', ', $array);

    }
}
