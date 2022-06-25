<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->model=Driver::query();
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        return view('admin.driver.index');

    }
    public function api(Request $request)
    {
        return DataTables::of($this->model->get())
            ->editColumn('gender', function ($object) {
                return $object->genderName;
            })
            ->editColumn('birthdate',function($object){
                return date('d-m-Y',strtotime($object->birthdate));
            })
            ->addColumn('edit',fn($object)=>$object->id)
            ->make(true);
    }
    public function edit(Driver $driver)
    {
//        $course=Course::query()->where('id',$driver->id)->get();

        $course=Driver::find(1)->course;
        $driver->course=$course;
        return view('admin.driver.edit',[
            'driver'=>$driver,
            ]
        );
    }
}
