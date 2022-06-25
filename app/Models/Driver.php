<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $cast = [
        'birthdate'=>'date:d-m-Y',
    ];
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

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
