<?php

namespace App\Http\Controllers;

use App\Actions\CreateDriverAction;
use App\Enums\LessonStatusEnum;
use App\Enums\LevelEnum;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('driver');
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $driver = Driver::query()
            ->where('id', $this->guard->user()->id)
            ->with('course')
            ->first();
        return view('driver.index', [
            'driver' => $driver,
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $arr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'id_numbers',
                'file',
            ]);
            $driver = Driver::query()->where('id', '=', $this->guard->user()->id);
            $driver->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'phone_numbers' => $request->phone_numbers,
                'id_numbers' => $request->id_numbers,
            ]);
            if (isset($request->file)) {
                $driver->update([
                    'file' => $request->file,
                ]);
            }
            DB::commit();
            return Redirect::back();
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }

    public function lessons()
    {
        $lessons = Lesson::query()->with('instructor:id,name,email,phone_numbers')
            ->where('driver_id', $this->guard->user()->id)
            ->paginate(15);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('driver.lessons', [
            'lessons' => $lessons,
        ]);
    }

    public function create()
    {

        return view('driver.add');

    }

    public function store(Request $request)
    {
        $request->is_full = $request->boolean('is_full');
        $dates = CreateDriverAction::AddLessons($request, $this->guard->user()->id);
        return Redirect::route('drivers.lessons');
    }

    public function edit($id)
    {
        try {
            // Validate the value...

            $lesson_info = Lesson::query()
                ->where('id', $id)
                ->with('instructor:id,name,phone_numbers,email')
                ->firstOrFail();
            $ins = LessonStatusEnum::CanBeCancel($lesson_info->status) ?
                Instructor::query()
                    ->where('level', LevelEnum::INSTRUCTOR->value)
                    ->get() : null;
            return view('driver.edit', [
                'lesson' => $lesson_info,
                'instructors' => $ins,
            ]);
        } catch (Throwable $e) {
            report($e);
            return Redirect::back()->withErrors([
                'message' => 'Buổi học không tồn tại',
            ]);
        }

    }

    public function newInsApi(Request $request)
    {
        $instructor = Instructor::query()
            ->where('id', $request->id)
            ->first();
        return $instructor;
    }

    public function cancel($id)
    {
        try {
            // Validate the value...
            $check = Lesson::query()->where('id', $id)->firstOrFail();
            if ($check->date < date('Y/m/d')) {
                Lesson::query()->where('id', $id)->update([
                    'status' => LessonStatusEnum::CANCELED->value,
                ]);
            }
            return Redirect::back();
        } catch (Throwable $e) {
            report($e);

            return Redirect::back();
        }
    }
}
