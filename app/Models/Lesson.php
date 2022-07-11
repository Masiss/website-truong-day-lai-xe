<?php

namespace App\Models;

use DateInterval;
use DatePeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function getDate($date, array $dow, int $limit)
    {
        $schedule = array();
        while (count($schedule) < $limit) {
            $date->setISODate($date->format('o'), $date->format('W') + 1);
            // set object to Monday on next week
            $periods = new DatePeriod($date, new DateInterval('P1D'), 5);
            // get all 1day periods from Monday to +6 days
            $days = iterator_to_array($periods);
            // convert DatePeriod object to array
            foreach ($days as $day) {
                if (count($schedule) < $limit) {
                    if (in_array($day->format('D'), $dow, true)) {
                        $schedule[] = $day->format('Y/m/d');

                    }
                } else {
                    return $schedule;
                }

            }
            $date->setISODate($date->format('o'), $date->format('W') + 1);
        }
        return $schedule;

    }
}
