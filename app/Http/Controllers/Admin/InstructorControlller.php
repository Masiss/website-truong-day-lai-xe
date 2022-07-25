<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ActionForInstructor;
use App\Enums\LevelEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Instructor;
use App\Models\Lesson;
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
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $instructors = Instructor::query()->paginate(15);
        $instructors->totalPage = ceil($instructors->total() / $instructors->perPage());
        return view('admin.ins.index', [
            'instructors' => $instructors,
        ]);

    }

    public function create()
    {
        return view('admin.ins.create');
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

    public function edit(Instructor $instructor)
    {
        return view('admin.ins.edit', [
            'instructor' => $instructor,
        ]);
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

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $new_ins = ActionForInstructor::GetInstructor();
            Lesson::query()->where('ins_id', $id)->update([
                'ins_id' => $new_ins
            ]);
            Instructor::query()->where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.instructors.index');
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }
}
