<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateDriver;
use App\Enums\GenderNameEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Course;
use App\Models\Driver;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->model = Driver::query();
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $drivers = Driver::query()->with('course')->paginate(15);
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
            $arr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'id_numbers',
                'email',
                'file',
                'is_full',
            ]);
            $request->is_full = $request->boolean('is_full');
            $password = Hash::make(Str::random(8));
            //add Course
            $course_id = CreateDriver::createCourse($request);
            $driver_id = Driver::query()
                ->create([
                    'name' => $arr['name'],
                    'gender' => $arr['gender'],
                    'course_id' => $course_id,
                    'birthdate' => $arr['birthdate'],
                    'phone_numbers' => $arr['phone_numbers'],
                    'id_numbers' => $arr['id_numbers'],
                    'email' => $arr['email'],
                    'file' => $arr['file'],
                    'is_full' => $arr['is_full'],
                    'password' => $password,
                ])->id;
            //add lessons
            CreateDriver::AddLessons($request, $driver_id);
            DB::commit();
            echo "1";
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function edit(Driver $driver)
    {
        $course = Course::query()->where('id', $driver->course_id)->first();
        $lessons = Lesson::query()->with('driver')->with('instructor')
            ->where('driver_id', $driver->id)->get();
        $lessons->count = $lessons->count();
//        $lessons->count=
        return view('admin.driver.edit', [
                'driver' => $driver,
                'course' => $course,
                'lessons' => $lessons,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        Driver::query()->where('id', $id)
            ->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
            ]);
        if ($request->file) {
            Driver::where('id', $id)->update(['file' => $request->file]);
        }
        return redirect()->route('admin.drivers.index');
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Driver::query()->where('id',$id)
                ->with('course')
                ->with('lessons')
                ->delete();
            DB::commit();
            return redirect()->route('admin.drivers.index');
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }
}
