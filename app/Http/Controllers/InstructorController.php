<?php

namespace App\Http\Controllers;

use App\Models\MonthSalary;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class InstructorController extends Controller
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
        return view('ins.index');
    }

    public function salaries()
    {
        MonthSalary::query()->where('ins', session('id'))->get();
    }


}
