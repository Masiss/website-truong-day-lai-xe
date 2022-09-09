<?php

namespace App\Http\Controllers;

use App\Enums\LevelEnum;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        if (auth('driver')->check()) {
            $title = 'Học viên';
        } elseif (auth('instructor')->check()) {
            switch (auth('instructor')->user()->level) {
                case (LevelEnum::ADMIN->name):
                    $title = 'Admin';
                    break;
                case (LevelEnum::INSTRUCTOR->name):
                    $title = 'Giáo viên';
                    break;
            }
        } else {
            $title = "";
        }
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
        View::share('title', $title);
    }
    public function calendar()
    {

        return view('apps.calendar');
    }

    public function calendarAPI()
    {
        $events = Lesson::lessonsCalendar();
        return response()->json($events);
    }
    public function search(Request $request)
    {

        $table = $request->table;
        $input = $request->input;
        session(['input' => $input]);
        $page = $request->page;
        switch ($table) {
            case ('drivers'):
                $data = Driver::query()
                    ->where('name', 'like', '%'.$input.'%')
                    ->with('course')
                    ->offset($page * 15)
                    ->paginate(15);
                $data->totalPage = ceil($data->total() / $data->perPage());
                return view('apps.table.admin.driver')->with('drivers', $data);
            case('instructors'):
                $data = Instructor::query()
                    ->where('name', 'like', '%'.$input.'%')
                    ->offset($page * 15)
                    ->paginate(15);
                return view('apps.table.admin.instructor')->with('instructors', $data);

            default:
                return null;
        }
    }
}
