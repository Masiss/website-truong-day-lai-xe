<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActionForInstructor;
use App\Actions\Instructor\GetInstructorForLessonsAction;
use App\Enums\LevelEnum;
use App\Enums\SalaryStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class InstructorControlller extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $instructors = Instructor::query()
            ->sortable()
            ->paginate(15);
        $instructors->totalPage = ceil($instructors->total() / $instructors->perPage());
        return view('admin.ins.index', [
            'instructors' => $instructors,
        ]);

    }

    public function store(StoreInstructorRequest $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $password = Hash::make(Str::random(8));
            $id = Instructor::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_numbers' => $request->phone_numbers,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'avatar' => $request->avatar,
                'password' => $password,
                'level' => LevelEnum::INSTRUCTOR->value,
            ]);
            DB::commit();
            echo '1';
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }

    }

    public function create()
    {
        return view('admin.ins.create');
    }

    public function edit(Instructor $instructor)
    {
        return view('admin.ins.edit', [
            'instructor' => $instructor,
        ]);
    }

    public function show(Instructor $instructor)
    {
        $month_salaries = MonthSalary::query()
            ->where('id', $instructor->id)
            ->get();
        $lessons = Lesson::query()
            ->where('ins_id', $instructor->id)
            ->with('driver')
            ->paginate(7);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('admin.ins.show', [
            'instructor' => $instructor,
            'month_salaries' => $month_salaries,
            'lessons' => $lessons,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $getPendingSalaries = MonthSalary::query()
                ->where('ins_id', $id)
                ->where('status', SalaryStatusEnum::PENDING->value)
                ->first();
            if ($getPendingSalaries) {
                return redirect()->route('admin.instructors.index')
                    ->withErrors([
                        'message' => "Còn lương chưa duyệt, không thể xóa giáo viên này",
                    ]);
            }
            $new_ins = GetInstructorForLessonsAction::handle();
            Lesson::query()->where('ins_id', $id)->update([
                'ins_id' => $new_ins
            ]);
            Instructor::query()->where('id', $id)->delete();
            $name = Instructor::query()
                ->where('id', $id)
                ->withTrashed()
                ->first()
                ->name;
            DB::commit();
            return redirect()->route('admin.instructors.index')
                ->with('status', 'Đã xóa thành công giáo viên '.$name);
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request, $id)
    {
        $ins = Instructor::query()->where('id', $id)
            ->where('level', '=', LevelEnum::INSTRUCTOR->value);
        $ins->update([
            'name' => $request->name,
            'phone_numbers' => $request->phone_numbers,
            'avatar' => $request->avatar
        ]);
        return redirect()->route('admin.instructors.index');

    }
}
