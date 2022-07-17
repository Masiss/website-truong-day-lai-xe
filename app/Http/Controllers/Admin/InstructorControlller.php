<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LevelEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

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
        return view('admin.ins.index');

    }

    public function api(Request $request)
    {
        return DataTables::of(Instructor::query()->where('level', 1)->get())
            ->editColumn('gender', fn($object) => $object->gender === 1 ? 'Nữ' : 'Nam')
            ->editColumn('avatar', fn($object) => Storage::url($object->avatar))
            ->addColumn('edit', fn($object) => $object->id)
            ->addColumn('delete', fn($object) => $object->id)
            ->make(true);
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
            $path = Storage::disk('public')->put('avatar', $request->avatar);
            $password = Hash::make(Str::random(8));
            $id = Instructor::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_numbers' => $request->phone_numbers,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'avatar' => $path,
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
        $instructor->avatar = Storage::url($instructor->avatar);
        $ins = $instructor;
        return view('admin.ins.edit', [
            'ins' => $ins,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ins = Instructor::query()->where('id', $id)
            ->where('level', '=', LevelEnum::INSTRUCTOR->value);
        $ins->update([
            'name' => $request->name,
            'phone_numbers' => $request->phone_numbers,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        ]);
        if ($request->avatar) {
            $path = Storage::disk('public')->put('avatar', $request->avatar);
            $ins->update(['avatar' => $path]);
        }
        return redirect()->route('admin.instructors.index');

    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $ins = Instructor::find($id)->delete();
            DB::commit();
            return redirect()->route('admin.instructors.index');
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }
}
