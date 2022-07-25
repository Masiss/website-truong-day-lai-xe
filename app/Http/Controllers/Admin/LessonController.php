<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActionForLessons;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

    public function index(Request $request)
    {
        $lessons = ActionForLessons::filterLessons($request->choose);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('admin.lessons', [
            'lessons' => $lessons,
        ]);
    }

}
