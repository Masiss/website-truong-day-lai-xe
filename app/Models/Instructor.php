<?php

namespace App\Models;

use App\Enums\LevelEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

//class Instructor extends Model
class Instructor extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use SoftDeletes;
    use Authenticatable;


    protected $fillable = [
        'name',
        'email',
        'phone_numbers',
        'birthdate',
        'gender',
        'salary',
        'avatar',
        'password',
        'level',
        'created_at',
        'updated_at'
    ];

    public static function checkLevel()
    {
        if (auth()->guard('instructor')->user()->level == LevelEnum::INSTRUCTOR->value) {
            return LevelEnum::INSTRUCTOR->name;
        } elseif (auth()->guard('instructor')->user()->level == LevelEnum::ADMIN->value) {
            return LevelEnum::ADMIN->name;
        } else {
            return redirect()->route('login');
        }

    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'ins_id', 'id');
    }

    public function month_salaries()
    {
        return $this->hasMany(MonthSalary::class, 'ins_id','id');
    }

}
