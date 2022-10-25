<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'phone_numbers',
        'email',
        'time_contacting',
        'type_contacting',
        'message',
    ];
}
