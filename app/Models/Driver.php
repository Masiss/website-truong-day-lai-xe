<?php

namespace App\Models;

use App\Enums\DaysOfWeekEnum;
use App\Enums\GenderNameEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;

//class Driver extends Model
class Driver extends \Illuminate\Foundation\Auth\User

{
    use Sortable;
    use HasFactory;
    use SoftDeletes;
    use Authenticatable;

    public $sortable = [
        'id',
        'name',
    ];
    protected $fillable = [
        'name',
        'gender',
        'gender',
        'course_id',
        'id_numbers',
        'email',
        'phone_numbers',
        'birthdate',
        'file',
        'is_full',
        'password',
        'created_at',
        'updated_at',
        'days_of_week',

    ];
    protected $cast = [
        'birthdate' => 'date:d-m-Y',
    ];


//    protected $dateFormat = 'd-m-Y';

//    protected function serializeDate($date)
//    {
//        return $date->format('d-m-Y');
//    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'driver_id', 'id');
    }

    public function birthdateForEditing()
    {
        return date('Y-m-d', strtotime($this->birthdate));
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($value) => GenderNameEnum::toVNese($value),
            set: fn($value) => GenderNameEnum::from($value)->value,
        );
    }

    public static function FromDatabaseToString($array)
    {
        $array = Arr::map($array, function ($value) {
            return DaysOfWeekEnum::getValueByKey($value);
        });
        return implode(', ', $array);

    }

    protected function daysOfWeek(): Attribute
    {
        return Attribute::make(
            get: fn($value) => self::FromDatabaseToString(json_decode($value)),
            set: fn($value) => json_encode($value),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::url($value),
            set: fn($value) => Storage::disk('public')
                ->put('file', $value . '.jpg'),
        );
    }

    protected function birthdate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d-m-Y', strtotime($value)),
//            set: fn($value) => date('Y-m-d', strtotime($value)),
        );
    }

    protected function isFull(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == 1 ? "Có" :
                ($value == 0 ? "Không"
                    : ""),
        );
    }


}
