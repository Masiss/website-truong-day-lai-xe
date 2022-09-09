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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->model = Driver::query();
//        $route = Route::currentRouteName();
//        $breadCrumb = explode('.', $route);
//        $pageName = last($breadCrumb);
//        View::share('pageName', ucfirst($pageName));
//        View::share('breadCrumb', $breadCrumb);
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
            ]);
            $driverArr['is_full'] = $request->boolean('is_full');

            $lessonArr = $request->only([
                'days_of_week',
                'lesson',
                'shift',
                'last',
            ]);
            $courseArr = $request->only([
                'days_of_week',
                'type',
                'lesson',
            ]);
            $lessonArr['lesson'] = $courseArr['lesson'];

            $driverArr['password'] = Hash::make(Str::random(8));
            //add Course
            $driverArr['course_id'] = CreateDriverAction::createCourse($courseArr, $driverArr['is_full'],$lessonArr['last']);
            $driver_id = Driver::query()
                ->create($driverArr)
                ->id;
            $lessonArr['driver_id'] = $driver_id;
            //add lessons
            CreateDriverAction::AddLessons($lessonArr, $driverArr['is_full']);

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

            Lesson::query()
                ->where('driver_id',$id)
                ->delete();
            Course::query()
                ->where('driver_id',$id)
                ->delete();
            $name = Driver::query()->where('id', $id)->withTrashed()->first()->name;
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
