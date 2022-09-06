<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $configs=Config::query()
            ->where('key','like','banner%')
            ->get();

        return view('index');
    }
}
