<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEditProfileInfo extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profilePhoto' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'backgroundProfile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'website' => 'nullable|string|max:255',
            'founded' => 'nullable|integer',
            'weekday_hours' => 'nullable|string|max:100',
            'saturday_hours' => 'nullable|string|max:100',
            'sunday_hours' => 'nullable|string|max:100',
            'holiday_hours' => 'nullable|string|max:100',

        ];
    }
}
