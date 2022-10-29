<?php

namespace App\Models;

use App\Enums\TypeContactEnums;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected function typeContacting():Attribute
    {
        return Attribute::make(
            get:fn($value)=>TypeContactEnums::toVNese($value),
        );
    }
    protected function createdAt():Attribute
    {
        return Attribute::get(fn($value)=>date("M j",strtotime($value)));
    }
}
