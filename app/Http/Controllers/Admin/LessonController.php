<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LessonStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->model = Lesson::query();
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        return view('admin.lessons');
    }

    public function api()
    {
        return DataTables::of(Lesson::query()
//            ->join('drivers', 'drivers.id', '=', 'lessons.driver_id')
//            ->join('instructors', 'instructors.id', '=', 'lessons.ins_id')
            ->get())
            ->addColumn('driver_name', function ($object) {
                $driver = Driver::query()->where('id', '=', $object->driver_id)->first();
                return $driver->name;
            })
            ->addColumn('ins_name', function ($object) {
                $ins = Instructor::query()->where('id', $object->ins_id)->first();
                return $ins->name;
            })
            ->editColumn('status', fn($object) => LessonStatusEnum::from($object->status)->name)
            ->editColumn('rating', fn($object) => $object->rating.' / 5')
            ->editColumn('date',
                fn($object) => $object->start_at.' giờ '.date_format(new \DateTime($object->date), 'd/m/Y'))
            ->addColumn('edit', fn($object) => $object->id)
            ->make(true);
    }
}
