<?php

namespace App\Models;

use App\Actions\SetLessonForCalendarAction;
use App\Enums\LessonStatusEnum;
use App\Enums\LevelEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Kyslik\ColumnSortable\Sortable;

class Lesson extends Model
{
    use Sortable;
    use HasFactory;
    use SoftDeletes;

    public $sortable = [
        'last',
        'rating',
        'status',
    ];
    protected $fillable = [
        'driver_id',
        'ins_id',
        'last',
        'start_at',
        'date',
        'report',
        'rating',
        'status',
    ];

    static public function lessonsCalendar()
    {
        if (auth('instructor')->check()) {
            if (LevelEnum::isAdmin()) {
                $data = Lesson::query()
                    ->with('driver')
                    ->get();

            } else {
                $data = Lesson::query()
                    ->with('driver')
                    ->where('ins_id', auth('instructor')->user()->id)
                    ->orderBy('date', 'DESC')
                    ->orderBy('start_at', 'ASC')
                    ->get();
            }
        } elseif (auth('driver')->check()) {
            $data = Lesson::query()
                ->with('instructor')
                ->where('driver_id', auth('driver')->user()->id)
                ->get();
        }
        $calendar = SetLessonForCalendarAction::handle($data);
        return $calendar;
    }

    public function dateForEditing()
    {
        return date('Y-m-d', strtotime($this->date));
    }

    public function timeForProcressing()
    {
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'ins_id', 'id');

    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => LessonStatusEnum::StatusInVNese($value),
//            set: fn() => LessonStatusEnum::PENDING->value,
        );
    }

    protected function report(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? $value : "<Trống>",
        );
    }

    protected function last(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value . " tiếng",
        );
    }

    protected function startAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value . " giờ",
        );
    }

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d-m-Y', strtotime($value)),
        );
    }

}
