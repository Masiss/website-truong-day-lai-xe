<?php

namespace App\Http\Controllers;

use App\Actions\createCourse;
use App\Actions\CreateDriverAction;
use App\Actions\StoreDriver;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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

            $driverArr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'id_numbers',
                'email',
                'file',
                'is_full',
                'password'
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

            //add Course
            $driverArr['course_id'] = CreateDriverAction::createCourse($courseArr, $driverArr['is_full'],
                $lessonArr['last']);
            $driver = Driver::query()
                ->create($driverArr);
            $driver_id = $driver->id;
            $lessonArr['driver_id'] = $driver_id;
            //add lessons
            CreateDriverAction::AddLessons($lessonArr, $driverArr['is_full']);
            DB::commit();
            auth('driver')->login($driver);
            return \redirect('./login');
        } catch (Throwable $e) {
            DB::rollBack();
            echo $e;
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
            if (auth('driver')->attempt($credentials, $remember)) {
                $user = Driver::query()
                    ->where('email', '=', $credentials['email'])
                    ->first();
                auth('driver')->login($user, $remember);
                return redirect()->route('drivers.index');
            }
            if (auth('instructor')->attempt($credentials, $remember)) {
                $user = Instructor::query()
                    ->where('email', '=', $credentials['email'])
                    ->first();
                auth('instructor')->login($user, $remember);
                if (Instructor::isAdmin()) {
                    return redirect()->route('admin.index');
                } elseif (!Instructor::isAdmin()) {
                    return redirect()->route('instructors.index');

                }
//                return redirect()->route("$level.index");
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
