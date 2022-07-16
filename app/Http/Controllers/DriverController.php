<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DriverController extends Controller
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
        $driver = Driver::query()->where('id', '=', auth()->guard('driver')->user()->id)->first();
        $course = Course::query()->where('id', '=', $driver->course_id)->first();
        $course->days_of_week = implode(',', json_decode($course->days_of_week));
        return view('driver.index', [
            'driver' => $driver,
            'course' => $course,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the value...
            $arr = $request->only([
                'name',
                'gender',
                'birthdate',
                'phone_numbers',
                'id_numbers',
                'file',
            ]);
            dd($arr);
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }
}
