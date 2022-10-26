<?php

namespace App\Http\Requests;

use App\Enums\TypeContactEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>[
                'string',
                'required',
            ],
            'email'=>[
                'email',
                'required',
            ],
            'phone_numbers'=>[
                'string',
                'size:10',
            ],
            'time_contacing'=>[
                'nullable',
                'numberic',
            ],

        ];
    }
}
