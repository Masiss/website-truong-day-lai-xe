<?php

namespace App\Models;

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

}
