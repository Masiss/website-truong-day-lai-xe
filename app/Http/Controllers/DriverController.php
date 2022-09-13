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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('driver');

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

    public function lessons()
    {
        $lessons = Lesson::query()->with('instructor:id,name,email,phone_numbers')
            ->where('driver_id', $this->guard->user()->id)
            ->sortable()
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
        $is_full = $request->boolean('is_full');
        $lessonArr = $request->only([
            'days_of_week',
            'last',
            'shift',
        ]);
        $lessonArr['driver_id'] = auth('driver')->user()->id;
        $dates = CreateDriverAction::AddLessons($lessonArr, $is_full);
        return redirect()->route('drivers.lessons')
            ->with('status', 'Đăng kí buổi học thành công');
    }

    public function edit($id)
    {
        try {
            // Validate the value...

            $lesson_info = Lesson::query()
                ->where('id', $id)
                ->with('instructor:id,name,phone_numbers,email,level')
                ->firstOrFail();
            $ins = LessonStatusEnum::CanBeCancelled($lesson_info->status) ?
                Instructor::query()
                    ->where('level', LevelEnum::INSTRUCTOR->value)
                    ->get() : null;
            return view('driver.edit', [
                'lesson' => $lesson_info,
                'instructors' => $ins,
            ]);
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->withErrors([
                'message' => 'Buổi học không tồn tại',
            ]);
        }

    }

    public function newInsApi(Request $request)
    {
        $instructor = Instructor::query()
            ->where('id', $request->id)
            ->first();
        return response()
            ->json([
                'name' => $instructor->name,
                'email' => $instructor->email,
                'phone_numbers' => $instructor->phone_numbers,
            ]);
    }

    public function cancel($id)
    {
        try {
            // Validate the value...
            $lesson = Lesson::query()->where('id', $id);
            $check = $lesson->firstOrFail();
            if ($check->date < date('Y/m/d')) {
                $lesson->update([
                    'status' => LessonStatusEnum::CANCELED->value,
                ]);
            }
            $lesson = $lesson->first();
            return redirect()->back()
                ->with('status', 'Đã hủy buổi học '.$lesson->start_at.' '.$lesson->date);
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()
                ->withErrors([
                    'message' => 'Đã xảy ra lỗi, vui lòng thử lại',
                ]);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        DB::enableQueryLog();
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
                'name' => $arr['name'],
                'gender' => $arr['gender'],
                'birthdate' => $arr['birthdate'],
                'phone_numbers' => $arr['phone_numbers'],
                'id_numbers' => $arr['id_numbers'],
            ]);
            if (isset($request->file)) {
                Storage::disk('public')->delete($driver->first()->file);
                $path = Storage::disk('public')->
                putFileAs('file', $arr['file'], auth('driver')->user()->id.'.jpg');
                $driver->update([
                    'file' => $path,
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

    public function getRating(Lesson $id)
    {
        return response()
            ->json($id->rating);
    }

    public function updateLesson(Lesson $lesson, Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            if (isset($request->rating)) {
                $request->validate([
                    'rating' => 'between:0,5'
                ]);
                $lessonArr = $request->only([
                    'rating',
                ]);
            } else {
                $request->validate([
                    'date' =>
                        'date_format:Y-m-d',
                    'start_at' =>
                        'int' | 'between:6,16'

                ]);
                $lessonArr = $request->only([
                    'start_at',
                    'date',
                    'rating',
                ]);
                $lessonArr['start_at'] = preg_replace("/[^0-9]/", "", $lessonArr['start_at']);

            }
            Lesson::query()
                ->where('id', $lesson->id)
                ->update($lessonArr);
            DB::commit();
            return response()
                ->json(['status' => 'Cập nhật thành công']);
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return response()
                ->json([
                    'status' => 'Đã xảy ra lỗi, vui lòng kiểm tra lại thông tin đã chọn',
                ]);
        }
    }
}
