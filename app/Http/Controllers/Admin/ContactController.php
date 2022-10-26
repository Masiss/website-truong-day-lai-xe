<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TypeContactEnums;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $types = TypeContactEnums::cases();
        foreach ($types as $type) {
            $type = TypeContactEnums::toVNese($type);
        }
        return view('admin.contact.index', [
            'types' => $types
        ]);
    }

    public function api(Request $request)
    {
        $contacts = Contact::query();
        $type=$request->type;
       if(isset($type)){
           $contacts=$contacts->where('type_contacting',$type)->get();
       }else{
           $contacts=$contacts->get();
       }
        return view('apps.contact-list', [
            'contacts' => $contacts
        ]);
    }

    public function show()
    {

    }

    public function destroy()
    {

    }

    public function reply()
    {

    }

}
