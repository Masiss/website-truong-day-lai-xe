<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'bail|required|filled|string',
            'gender'=>'bail|required|boolean',
            'id_numbers'=>'bail|required|string|size:12',
            'email'=>'bail|required|email',
            'phone_numbers'=>'bail|required|size:10',
            'birthdate'=>'bail|required|before'.now()->subYears(18)->toDateString(),
            'file'=>'bail|required|file',
            'is_full'=>'required|boolean',
        ];
    }
}
