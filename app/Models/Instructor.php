<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;
    use SoftDeletes;

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
