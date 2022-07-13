<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

//class Driver extends Model
class Driver extends \Illuminate\Foundation\Auth\User

{
    use HasFactory;
    use SoftDeletes;
    use Authenticatable;

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
    ];
    protected $cast = [
        'birthdate' => 'date:d-m-Y',
    ];

    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attribute) {
                $attribute = $attribute['gender'];
                return ($attribute === 0) ?
                    'Nam'
                    : 'Nữ';
            }
        );
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
