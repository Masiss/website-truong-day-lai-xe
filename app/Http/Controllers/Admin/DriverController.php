<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateDriverAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Course;
use App\Models\Driver;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->model = Driver::query();
    }

    public function index()
    {

        $drivers = Driver::query()
            ->with('course')
            ->sortable()
            ->paginate(15);
        $drivers->totalPage = ceil($drivers->total() / $drivers->perPage());
        return view('admin.driver.index', [
            'drivers' => $drivers,
        ]);

    }


    public function create()
    {
        return view('admin.driver.create');
    }


    public function store(StoreDriverRequest $request)
    {
        DB::beginTransaction();
        try {
//            $request=$request->validated();
            $driverArr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'id_numbers',
                'email',
                'file',
                'is_full',
                'days_of_week',

            ]);
            $lessonArr = $request->only([
                'days_of_week',
                'shift',
                'last',
            ]);
            $driverArr['is_full'] = $request->boolean('is_full');


            $courseArr = $request->only([
                'type',
            ]);

            $driverArr['password'] = Hash::make(Str::random(8));
            //add Course
//            $driverArr['course_id'] = CreateDriverAction::createCourse($courseArr, $driverArr['is_full'], $lessonArr['last']);
            $driverArr['course_id'] = Course::query()
                ->where('type', $courseArr['type'])
                ->first()
                ->id;
            $driver_id = Driver::query()
                ->create($driverArr)
                ->id;
            //store img
            $path = Storage::disk('public')
                ->putFileAs('file', $driverArr['file'], $driver_id . '.jpg');
            Driver::where('id', $driver_id)->update([
                'file' => $path,
            ]);

            $lessonArr['driver_id'] = $driver_id;
            //add lessons
            $total_lessons = CreateDriverAction::AddLessons($lessonArr, $driverArr['is_full']);
            CreateDriverAction::createBill($driver_id, $driverArr['is_full'], $driverArr['course_id'], $total_lessons);
            DB::commit();
            return redirect()
                ->route('admin.drivers.index')
                ->with('status', 'Thêm thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()
                ->with(['status' => 'Xem lại thông tin'])
                ->withInput();
        }
    }

    public function show(Driver $driver)
    {
        $course = Course::query()
            ->where('id', $driver->course_id)
            ->first();
        $lessons = Lesson::query()
            ->with('driver')
            ->with('instructor')
            ->where('driver_id', $driver->id)->paginate(7);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('admin.driver.show', [
                'driver' => $driver,
                'course' => $course,
                'lessons' => $lessons,
            ]
        );
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Driver::query()->where('id', $id)
                ->with('course')
                ->with('lessons')
                ->delete();
            $driver = Driver::where('id', $id)->withTrashed()->first();
            Lesson::query()
                ->where('driver_id', $id)
                ->delete();
            $name = $driver->name;
            DB::commit();
            return redirect()->route('admin.drivers.index')
                ->with('status', 'Đã xóa thành công học viên ' . $name);
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }


}
