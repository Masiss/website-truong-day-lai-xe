<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->model = Config::query();
    }

    public function index()
    {
        $arr_banner = ['banner_1', 'banner_2', 'banner_bottom', 'logo'];
        $configs = Config::query()->get();
        foreach ($configs as $config) {
            if (in_array($config->key, $arr_banner, true)) {
                $config->value = Storage::url($config->value);
            }
        }
        return view('admin.config', [
            'configs' => $configs,
            'arr_banner' => $arr_banner,
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Config::isImg($request->key)) {
                $path = $request->file('new_value')->storeAs(
                    'homepage',
                    $request->key.'.jpg',
                    'public');
                Config::query()->where('key', $request->key)
                    ->update([
                        'value' => $path,
                    ]);
            } else {
                Config::query()->where('key', '=', $request->key)
                    ->update([
                        'value' => $request->new_value,
                    ]);
            }
            DB::commit();
            return back()->with(
                'status', 'Cập nhật thành công',
            );
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return redirect()->withErrors([
                'status', 'Đã xảy ra lỗi, vui lòng kiểm tra lại'
            ])->back();
        }
    }

}
