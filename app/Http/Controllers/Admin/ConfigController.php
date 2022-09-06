<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->model = Config::query();
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $configs = Config::query()->paginate(15);
        $configs->totalPage = ceil($configs->total() / $configs->perPage());
        return view('admin.config', [
            'configs' => $configs,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...

            Config::query()->create([
                'key' => $request->key,
                'value' => $request->value,
            ]);
            DB::commit();
            return Redirect::back();
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }

    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            Config::query()->where('key', '=', $request->key)
                ->update([
                    'value' => $request->new_value,
                ]);
            DB::commit();
            echo "1";
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }

}
