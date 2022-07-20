<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateDriver;
use App\Enums\GenderNameEnum;
use App\Http\Controllers\Controller;
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
use Yajra\DataTables\DataTables;

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
        return view('admin.driver.index');

    }

    public function api(Request $request)
    {
        return DataTables::of($this->model->get())
            ->editColumn('gender', fn($object) => GenderNameEnum::toVNese($object->gender))
            ->editColumn('birthdate', fn($object) => date('d-m-Y', strtotime($object->birthdate)))
            ->editColumn('file', fn($object) => Storage::url($object->file))
            ->addColumn('edit', fn($object) => $object->id)
            ->addColumn('delete', fn($object) => $object->id)
            ->make(true);
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
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
            $arr['file'] = Storage::disk('public')
                ->put('file', $arr['file']);
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
        $driver->file = Storage::url($driver->file);
        $course = Course::query()
            ->where('id', $driver->course_id)
            ->first();
        $course->days_of_week = implode(',', json_decode($course->days_of_week));
        return view('admin.driver.edit', [
                'driver' => $driver,
                'course' => $course,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        Driver::query()->where('id', $id)
            ->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'phone_numbers' => $request->phone_numbers,
                'id_numbers' => $request->id_numbers,
                'email' => $request->email,
            ]);
//
        if ($request->file) {
            $file = Storage::disk('public')
                ->put('file', $request->file);
            Driver::where('id', $id)->update(['file' => $file]);
        }
        return redirect()->route('admin.drivers.index');
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $driver = Driver::query()->where('id', $id)->first();
            $course = Course::query()->where('id', $driver->course_id)->delete();
            $lesson = Lesson::where('driver_id', '===', $id)->delete();
            Driver::find($id)->delete();
            DB::commit();
            return redirect()->route('admin.drivers.index');
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }
}
