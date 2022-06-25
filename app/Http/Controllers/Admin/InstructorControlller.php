<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        return DataTables::of(Instructor::query()->get())
            ->editColumn('gender', function ($object) {
                return $object->gender === 1 ? 'Male' : 'Female';
            })
            ->make(true);
    }

    public function create()
    {

    }
}
