<?php

namespace App\Actions\Instructor;

use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class GetInstructorForLessonsAction
{
    public static function handle()
    {
        $sub = DB::table('lessons')
            ->select('ins_id', DB::raw('count(ins_id) as less_ins'))
            ->groupBy('ins_id')
            ->orderBy('less_ins', 'ASC')
            ->first();
        $ins_id = Instructor::query()->whereNotIn('id', function ($query) {
            $query->select('ins_id')->from('lessons');
        })->orWhere('id', '=', $sub->ins_id)
            ->first()->id;
        return $ins_id;
    }
}
