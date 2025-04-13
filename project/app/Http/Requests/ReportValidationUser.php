<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportValidationUser extends FormRequest
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'reportDate' => 'required|date',
            'description' => 'required|string|max:1000',
            'status' => 'required|in:okay,injured,critical',
        ];
    }
}
