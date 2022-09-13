<?php

namespace App\Http\Controllers;

use App\Enums\TypeContactEnums;
use App\Http\Requests\ContactFormRequest;
use App\Models\Config;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
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
    public function contactForm(ContactFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $contactArr = $request->only([
                'name',
                'email',
                'phone_numbers',
                'message',
                'time_contacting'
            ]);
            $contactArr['type_contacting'] = $request->message ?
                TypeContactEnums::ASKING->value :
                TypeContactEnums::CONSULT->value;
            Contact::create($contactArr);
            DB::commit();
            return back()->with('success', 'Thành công');
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error','Đã xảy ra lỗi,vui lòng thử lại');
        }
    }
}
