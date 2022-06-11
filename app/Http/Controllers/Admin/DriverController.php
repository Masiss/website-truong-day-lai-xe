<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

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
        return view('admin.index');

    }
    public function api(Request $request)
    {
        return DataTables::of(Driver::query()->get())
            ->editColumn('gender', function ($object) {
                return $object->genderName;
            })
            ->editColumn('birthdate',function($object){
                return date('d-m-Y',strtotime($object->birthdate));
            })
            ->make(true);
    }
}
