<?php

namespace App\Models;

use App\Enums\DaysOfWeekEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'days_of_week',
        'price',
        'price_per_day',
    ];

    public static function FromDatabaseToString($array)
    {
        $array = Arr::map(json_decode($array), function ($value) {
            return DaysOfWeekEnum::getValueByKey($value);
        });
        return implode(', ', $array);

    }
}
