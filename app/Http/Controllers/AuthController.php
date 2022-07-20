<?php

namespace App\Http\Controllers;

use App\Actions\createCourse;
use App\Actions\CreateDriver;
use App\Actions\StoreDriver;
use App\Enums\LevelEnum;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registering(StoreDriverRequest $request)
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
                'password',
            ]);

            $request->is_full = $request->boolean('is_full');
            $arr['password'] = Hash::make($request->password);
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
                    'password' => $arr['password'],
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

    public function login()
    {
        return view('login');
    }


    public function login_processing(Request $request)
    {
        try {
            // Validate the value...
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $remember = $request->save_login ? true : false;
            if (Auth::guard('driver')->attempt($credentials, $remember)) {
                $user = Driver::where('email', '=', $credentials['email'])->first();
                Auth::guard('driver')->login($user, $remember);
                return redirect()->route('drivers.index');
            }
            if (Auth::guard('instructor')->attempt($credentials, $remember)) {
                $user = Instructor::where('email', '=', $credentials['email'])->first();
                $user->level = LevelEnum::from($user->level);
                Auth::guard('instructor')->login($user, $remember);
                if ($user->level == LevelEnum::from(0)) {
                    return redirect()->route('admin.index');
                } elseif ($user->level == LevelEnum::from(1)) {
                    return redirect()->route('instructors.index');

                }
            }
            return Redirect::back()->withInput()->withErrors([
                'message' => 'Email hoặc mật khẩu không đúng'
            ]);


        } catch (Throwable $e) {
            report($e);
            return Redirect::back()->withInput()->withErrors([
                'message' => 'Email hoặc mật khẩu không đúng'
            ]);
        }

    }

    public function logout(Request $request)
    {
        // Validate the value...
        Auth::guard('instructor')->logout();
        Auth::guard('driver')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Session::flush();
        return redirect()->route('index');


    }
}
