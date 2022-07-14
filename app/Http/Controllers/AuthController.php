<?php

namespace App\Http\Controllers;

use App\Enums\LevelEnum;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
                'password'
            ]);
            $arr['is_full'] = filter_var($arr['is_full'], FILTER_VALIDATE_BOOLEAN);
            $request->lesson = (int) $request->last === 2 ? 20 : 10;


            $password = Hash::make($arr['password']);
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
                'created_at' => $date->format('Y/m/d'),

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
                ->whereNotExists(function ($query) {
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
                    'created_at' => date_format(new \DateTime(), 'Y/m/d'),
                ]);
            }
            DB::commit();
            echo "1";
        } catch (Throwable $e) {
            DB::rollBack();
            echo $e;
            return false;
        }
    }

    public function login()
    {

        if (!Auth::check()) {
            return view('login');
        } else {
            return redirect()->route('index');
        }
    }

    public function login_processing(Request $request)
    {
        try {
            // Validate the value...
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
//            $email = $request->email;
//            $password = $request->password;
            $remember = $request->save_login ? true : false;
            if (Auth::guard('driver')->attempt($credentials, $remember)) {
                $user = Driver::where('email', '=', $credentials['email'])->first();
                Auth::guard('driver')->login($user, $remember);
                return redirect()->route('index');
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
            return redirect()->route('login');


        } catch (Throwable $e) {
            report($e);
            dd($e);
            return false;
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
