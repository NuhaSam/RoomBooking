<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required |string',
            'type' => 'required | in:room,workspace',
            'number_of_seats' => 'required | integer ',
            'location' => 'required | string',
            'from_day' => 'required | string',
            'to_day' => 'required | string',
        ];
    }
}
