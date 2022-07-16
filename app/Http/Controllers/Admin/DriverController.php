<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Course;
use App\Models\Driver;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            ->editColumn('gender', fn($object) => $object->genderName)
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
            $arr['is_full'] = filter_var($arr['is_full'], FILTER_VALIDATE_BOOLEAN);
            $request->lesson = (int) $request->last === 2 ? 20 : 10;


            $password = Hash::make(Str::random(8));
            $course = $request->only([
                'days_of_week',
                'last',
            ]);
            $course['days_of_week'] = explode(',', $course['days_of_week']);


            $date = new \DateTime();
            if ($arr['is_full']) {
                $lessons = Lesson::getDate($date, $course['days_of_week'], $request->lesson);
                $course = Arr::add($course, 'price_per_day', null);
                $course = Arr::add($course, 'price', 3500000);
            } else {
                $lessons = Lesson::getDate($date, $course['days_of_week'], count($course['days_of_week']));
                $course = Arr::add($course, 'price_per_day', $request->last / 2 * 200000);
                $course = Arr::add($course, 'price', null);
            }
            $course_id = DB::table('courses')->insertGetId([
                'days_of_week' => json_encode($course['days_of_week']),
                'price' => $course['price'],
                'price_per_day' => $course['price_per_day'],
                'created_at' => date_format(new \DateTime(), 'Y/m/d H:i:s'),

            ]);
            $arr['file'] = Storage::disk('public')
                ->put('file', $arr['file']);
            $driver_id = DB::table('drivers')
                ->insertGetId([
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
                    'created_at' => date_format(new \DateTime(), 'Y/m/d H:i:s'),
                ]);
            $sub = DB::table('lessons')
                ->select('ins_id', DB::raw('count(*) as less_ins'))
                ->groupBy('driver_id', 'ins_id')
                ->orderBy('less_ins', 'ASC')
                ->limit(1)
                ->pluck('ins_id')
                ->first();
            $ins_id = DB::table('instructors')
                ->select('id')
                ->whereNotIn('id',function ($query) {
                    $query->select('ins_id')
                        ->from('lessons');
                })
                ->orWhere('id', $sub)
                ->pluck('id')
                ->first();
            if ($request->shift === 'AM') {
                $start_at = 7;
            } else {
                if ($request->shift === 'PM') {
                    $start_at = 14;
                }
            }

            foreach ($lessons as $date) {
                DB::table('lessons')->insert([
                    'driver_id' => $driver_id,
                    'ins_id' => $ins_id,
                    'last' => $request->last,
                    'start_at' => $start_at,
                    'date' => $date,
                    'created_at' => date_format(new \DateTime(), 'Y/m/d H:i:s'),
                    'status' => 0,

                ]);
            }
            DB::commit();
            echo "1";
        } catch (Throwable $e) {
            DB::rollBack();

            return false;
        }
    }

    public function edit(Driver $driver)
    {
//        $course=Course::query()->where('id',$driver->id)->get();
        $driver->file = Storage::url($driver->file);
        $course = Course::query()
            ->where('id', $driver->course_id)
            ->get()
            ->toArray()[0];
        $course['days_of_week'] = implode(',', json_decode($course['days_of_week']));

        return view('admin.driver.edit', [
                'driver' => $driver,
                'course' => $course,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $driver = DB::table('drivers');
        $driver->where('id', $id)
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
            $driver->update(['file' => $file]);
        }
        return redirect()->route('admin.drivers.index');
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $driver = Driver::query()->where('id', $id)->first();
            $course = Course::query()->where('id',$driver->course_id)->delete();
            $lesson = Lesson::where('driver_id', '===', $id);
            $lesson->delete();
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
