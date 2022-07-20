<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActionForLessons;
use App\Enums\LessonStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
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

    public function api(Request $request)
    {
        try {
            // Validate the value...
            $call = ActionForLessons::filterLessons($request);
            if (!$call) {
                return;
            }

            return DataTables::of($call)
                ->addColumn('driver_name', fn($object) => $object->driver->name)
                ->addColumn('ins_name', fn($object) => $object->instructor->name)
                ->editColumn('status', fn($object) => LessonStatusEnum::StatusInVNese($object->status))
                ->editColumn('rating', fn($object) => $object->rating.' / 5')
                ->editColumn('date',
                    fn($object) => $object->start_at.' giờ '.date_format(new \DateTime($object->date), 'd/m/Y'))
                ->make(true);
        } catch (Throwable $e) {
            report($e);

            return false;
        }

    }
}
