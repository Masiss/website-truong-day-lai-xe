<?php

namespace App\Http\Controllers;

use App\Enums\LessonStatusEnum;
use App\Enums\LevelEnum;
use App\Enums\SalaryStatusEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('instructor');
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $ins = Auth::guard('instructor')->user();
        return view('ins.index', [
            'ins' => $ins,
        ]);
    }

    public function salaries()
    {
        return view('ins.salaries');
    }

    public function api(Request $request)
    {

        return DataTables::of(MonthSalary::query()->with('instructor')
            ->where('ins_id', $this->guard->user()->id)
            ->get())
            ->editColumn('status',
                function ($object) {
                    return $object->status == SalaryStatusEnum::PENDING->value ? 'Đang chờ duyệt' :
                        ($object->status == SalaryStatusEnum::APPROVED->value ? 'Đã duyệt' : ' ');
                })
            ->editColumn('month', fn($object) => date_format(new \DateTime($object->month), 'm/Y'))
            ->addColumn('show', fn($object) => $object->id)
            ->make(true);
    }

    public function show($id)
    {
        $info = ActionController::showSalary($id);

        return view('ins.show', [
            'lessons' => $info->lessons,
            'month_salary' => $info->month_salary,
            'detail_salary' => $info->detail_salary,
        ]);
    }

    public function checkinAPI(Request $request)
    {
        return DataTables::of(Lesson::query()->where('ins_id', auth()->guard('instructor')->user()->id)
            ->with('driver')
            ->where('status', LessonStatusEnum::PENDING->value)
            ->select('*', 'lessons.id as lesson_id')
            ->get())
            ->editColumn('name', fn($object) => $object->driver->name)
            ->editColumn('phone_numbers', fn($object) => $object->driver->phone_numbers)
            ->editColumn('email', fn($object) => $object->driver->email)
            ->editColumn('date', fn($object) => date('d/m/Y', strtotime($object->date)))
            ->editColumn('status', fn($object) => LessonStatusEnum::from($object->status)->name)
            ->addColumn('checkin', fn($object) => $object->lesson_id)
            ->make(true);
    }

    public function checkin()
    {
        return view('ins.checkin');
    }

    public function updateStatus(Request $request, int $id)
    {
        try {
            // Validate the value...
            Lesson::query()->where('id', $id)->update([
                'status' => LessonStatusEnum::HAPPENED->value,
            ]);
            return Redirect::back();
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    public function updateInfo(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $get = Instructor::query()->where('id', auth()->guard('instructor')->user()->id)
                ->where('level', LevelEnum::INSTRUCTOR->value);
            if (isset($request->avatar)) {
                $path = Storage::disk('public')->put('avatar', $request->avatar);
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                    'avatar' => $request->avatar,
                ]);
            } else {
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                ]);
            }
            DB::commit();
            return Redirect::back();
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);

            return false;
        }

    }

    public function lessons()
    {
        return view('ins.lessons');
    }

    public function getLessons()
    {
        return DataTables::of(Lesson::query()->where('ins_id', $this->guard->user()->id)
            ->with('driver:id,name,email,phone_numbers')
            ->get())
            ->editColumn('name', fn($object) => $object->driver->name)
            ->editColumn('email', fn($object) => $object->driver->email)
            ->editColumn('phone_numbers', fn($object) => $object->driver->phone_numbers)
            ->editColumn('date', fn($object) => date('d/m/Y', strtotime($object->date)))
            ->editColumn('status', fn($object) => $object->status == LessonStatusEnum::PENDING->value ? "Chưa đến" :
                ($object->status == LessonStatusEnum::HAPPENED->value ? "Đã xong" :
                    ($object->status == LessonStatusEnum::CANCELED->value ? "Đã hủy" :
                        " ")))
                    ->make(true);

    }


}
