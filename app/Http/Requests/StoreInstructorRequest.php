<?php

namespace App\Http\Requests;

use App\Enums\LevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreInstructorRequest extends FormRequest
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
            'name' => 'bail|required|filled|string',
            'email' => 'bail|required|email',
            'phone_numbers' => 'bail|required|size:10',
            'birthdate' => 'bail|required|before:'.now()->subYears(18)->toDateString(),
            'gender' => 'bail|required|boolean',
            'avatar' => 'bail|required|file',
            'level' => new Enum(LevelEnum::class),
        ];
    }
}
