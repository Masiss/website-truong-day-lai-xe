<?php

namespace App\Http\Controllers;

use App\Actions\Instructor\GetLessonForCheckinAction;
use App\Actions\SalariesAction;
use App\Enums\LessonStatusEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('instructor');
//        $this->user = Instructor::query()
//            ->where('id', auth('instructor')->user()->id)
//            ->first();
    }

    public function index()
    {
        $ins = $this->guard->user();
        return view('ins.index', [
            'ins' => $ins,
        ]);
    }

    public function salaries()
    {
        $salaries = MonthSalary::query()
            ->with('instructor')
            ->where('ins_id', $this->guard->user()->id)
            ->sortable()
            ->paginate(15);
        $salaries->totalPage = ceil($salaries->total() / $salaries->perPage());
        return view('ins.salaries', [
            'salaries' => $salaries,
        ]);
    }

    public function show(MonthSalary $id)
    {
        $salary = MonthSalary::query()
            ->where('id', $id->id)->first();
        $divideMonthYear = explode('/', $salary->month);
        $month = $divideMonthYear[0];
        $year = $divideMonthYear[1];

        $info = SalariesAction::showSalary($id, $month, $year);
        $lessons = $info->lessons->paginate(15);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('ins.show', [
            'lessons' => $lessons,
            'month_salary' => $info->month_salary,
            'detail_salary' => $info->detail_salary,
        ]);
    }

    public function checkin()
    {
        $hour = date('H');
//        $lessons = Lesson::query()
//            ->where('ins_id', $this->guard->user()->id)
//            ->with('driver:id,name,email,phone_numbers')
//            ->where('status', LessonStatusEnum::PENDING->value)
//            ->where('date', date('Y/m/d'));
//        if ($hour > 6 && $hour <= 12) {
//           $lessons->where('start_at', '<=', 12);
//        }
        $lessons = GetLessonForCheckinAction::handle($hour);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('ins.checkin', [
            'lessons' => $lessons,
        ]);
    }

    public function updateStatus(Request $request, int $id)
    {
        $lesson = Lesson::query()->where('id', $id)->get()->first();
        $lesson->date = date("Y/m/d", strtotime($lesson->date));
        if ($lesson->date == date('Y/m/d') || $lesson->date < date('Y/m/d')) {
            Lesson::query()->where('id', $id)->update([
                'status' => LessonStatusEnum::HAPPENED->value,
            ]);
            return Redirect::back();
        } elseif ($lesson->date > date("Y/m/d")) {
            return Redirect::back()->withErrors([
                'message' => "Chưa đến ngày, chưa được checkin",
            ]);
        }


    }

    public function updateInfo(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $insArr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'avatar'
            ]);
            if (isset($insArr['avatar'])) {
                $insArr['avatar'] = Storage::disk('public')
                    ->putFileAs('file', $request->avatar, auth('instructor')->user()->id . '.jpg');
            }
            Instructor::query()->where('id', auth('instructor')->user()->id)
                ->update($insArr);
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
        $lessons = Lesson::query()->where('ins_id', $this->guard->user()->id)
            ->with('driver:id,name,email,phone_numbers')
            ->sortable()
            ->orderBy('date')
            ->orderBy('start_at')
            ->paginate(15);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('ins.lessons', [
            'lessons' => $lessons,
        ]);
    }

    public function changePassword()
    {
        return view('ins.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $password = Instructor::query()
            ->where('id', auth('instructor')->user()->id)->first()->password;
        $old_password = $request->password;
        $new_password = $request->new_password;
        $retype_password = $request->new_password1;
        if (!Hash::check($old_password, $password)) {
            return back()->withErrors('Sai mật khẩu hiện tại, vui lòng xem lại', 'status');
        }
        if ($new_password != $retype_password) {
            return back()->withErrors('Nhập lại mật khẩu sai, vui lòng xem lại', 'status');
        }
        if ($old_password === $new_password) {
            return back()->withErrors('Mật khẩu mới giống với mật khẩu hiện tại', 'status');
        }
        Instructor::query()
            ->where('id', auth('instructor')->user()->id)
            ->update([
                'password' => $password
            ]);
        return back()->with('status', 'Cập nhật mật khẩu thành công');
    }
}
