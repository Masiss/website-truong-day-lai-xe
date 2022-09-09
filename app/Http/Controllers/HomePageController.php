<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class HomePageController extends Controller
{
    public function __construct()
    {
        $configs = Config::query()
            ->get()->keyBy('key');
        foreach ($configs as $config) {
            $config->value = Config::isImg($config->key) ?
                Storage::url($config->value) :
                $config->value;
        }
        View::share('configs', $configs);
    }

    public function index()
    {
//        $configs = Config::query()
//            ->get()->keyBy('key');
//        foreach ($configs as $config) {
//            $config->value = Config::isImg($config->key) ?
//                Storage::url($config->value) :
//                $config->value;
//        }
//        $banner_1=$configs->get('banner_1');
//        $banner_2=$configs->get('banner_2');
//        $banner_bottom=$configs->get('banner_bottom');
//        $phone_numbers=$configs->get('phone_numbers');
//        $address=$configs->get('address');
//        $email=$configs->get('email');
        return view('index', [
//            'configs' => $configs,
        ]);
    }

    public function contact()
    {
        return view('homepage.contact');
    }
}
