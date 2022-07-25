<?php

namespace App\Models;

use App\Enums\GenderNameEnum;
use App\Enums\LevelEnum;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    protected function birthdate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d/m/Y', strtotime($value)),
//            set: fn($value) => date('Y/m/d', strtotime($value)),
        );
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($value) => GenderNameEnum::toVNese($value),
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Storage::url($value) : null,
            set: fn($value) => $value ? Storage::disk('public')->put('avatar', $value) : null,
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'ins_id', 'id');
    }

    public function month_salaries()
    {
        return $this->hasMany(MonthSalary::class, 'ins_id', 'id');
    }

}
