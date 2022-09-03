<?php

namespace App\Actions;

use Carbon\Carbon;

class SetLessonForCalendarAction
{
    public static function handle($lessons)
    {
        $calendar = array();
        foreach ($lessons as $lesson) {
            $object = new \stdClass();
            $object->id = $lesson->id;
            $object->title = auth('driver')->check() ? $lesson->instructor->name : $lesson->driver->name;
            if (auth('driver')->check()) {
                $object->url = route('drivers.lessons.edit', $lesson->id);
            } else {
                $object->subtitle = $lesson->instructor->name;
            }

            $time = Carbon::createFromTimeString(filter_var($lesson->start_at, FILTER_SANITIZE_NUMBER_INT));
            $start_time = $time->format('H:i:s');
            $last = filter_var($lesson->last, FILTER_SANITIZE_NUMBER_INT);
            $endTime = $time->addHours($last)->format('H:i:s');

            $object->start = $lesson->dateForEditing().'T'.$start_time;
            $object->end = $lesson->dateForEditing().'T'.$endTime;
            $object->allDay = false;
            $calendar[] = $object;
        }
        return $calendar;
    }
}
