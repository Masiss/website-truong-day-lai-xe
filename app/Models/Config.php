<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'key',
        'value',
    ];

    public static function isImg($key)
    {
        $arr = ['banner_1', 'banner_2', 'banner_bottom', 'logo'];
        if (in_array($key, $arr, true)) {
            return true;
        }
        return false;
    }
}
