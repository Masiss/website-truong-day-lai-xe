<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActionForLessons;
use App\Actions\Lesson\FilterLessonsAction;
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
    }

    public function index(Request $request)
    {
        $lessons = FilterLessonsAction::handle($request->choose);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('admin.lessons', [
            'lessons' => $lessons,
        ]);
    }

}
