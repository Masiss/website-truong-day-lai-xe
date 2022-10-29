<?php

namespace App\Http\Controllers;

use App\Enums\TypeContactEnums;
use App\Models\Contact;
use App\Models\Driver;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index()
    {
        $driver = Driver::query()
            ->whereMonth('created_at', '=', date('m'))
            ->count();
        $contact = Contact::query()
            ->where('type_contacting', '!=', TypeContactEnums::REPLIED)
            ->count();
        return view('admin.index', [
            'driver' => $driver,
            'contact' => $contact
        ]);
    }

    public function driverAPI()
    {
        $driver = Driver::query()
            ->whereMonth('created_at', '=', date('m'))
            ->pluck('name')
            ->toArray();
        return response()->json($driver);
    }

}
