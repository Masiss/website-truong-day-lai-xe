<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: function ($value,$attribute){
                $attribute=$attribute['gender'];
                return ($attribute===0)?
                    'Female'
                    :'Male';
            }
        );
    }
}
