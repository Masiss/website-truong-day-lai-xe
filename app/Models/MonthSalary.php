<?php

namespace App\Models;

use App\Enums\SalaryStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class MonthSalary extends Model
{
    use Sortable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ins_id',
        'month',
        'total_lessons',
        'total_hours',
        'total_salaries',
        'status',
    ];
    public $sortable = [
        'ins_id',
        'month',
        'total_lessons',
        'total_hours',
        'total_salaries',
        'status',
    ];

    protected function month(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('m/Y', strtotime($value)),
        );
    }

    protected function total_lessons(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value." buổi",
        );
    }

    protected function total_hours(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value." tiếng",
            set: fn($value) => $value,
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => SalaryStatusEnum::toVNese($value),
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d/m/Y', strtotime($value)),
        );
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'ins_id', 'id');
    }

    public function instructorWithTrashed()
    {
        return $this->belongsTo(Instructor::class, 'ins_id', 'id')->withTrashed();
    }

}
