<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LessonStatusEnum;
use App\Http\Controllers\Controller;
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

        return DataTables::of(Lesson::query()->orderBy('lessons.updated_at')
            ->with('instructor')
            ->with('driver')
            ->get())
            ->addColumn('driver_name', fn($object) => $object->driver->name)
            ->addColumn('ins_name', fn($object) => $object->instructor->name)
            ->editColumn('status', fn($object) => LessonStatusEnum::from($object->status)->name)
            ->editColumn('rating', fn($object) => $object->rating.' / 5')
            ->editColumn('date',
                fn($object) => $object->start_at.' giờ '.date_format(new \DateTime($object->date), 'd/m/Y'))
            ->make(true);
    }
}
