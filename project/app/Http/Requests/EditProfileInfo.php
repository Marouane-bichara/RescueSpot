<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileInfo extends FormRequest
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
            'name' => 'required|string|max:255',
            'birthday'           => 'nullable|date',
            'relationship_status'=> 'nullable|string',
            'bio'                => 'nullable|string|max:1000',
            'phone'              => 'nullable|string|max:20',
            'address'            => 'nullable|string|max:255',
            'city'               => 'nullable|string|max:100',
            'country'            => 'nullable|string|max:100',
            'profilePhoto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'backgroundProfile'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook'           => 'nullable|url',
            'twitter'            => 'nullable|url',
            'instagram'          => 'nullable|url',
            'linkedin'           => 'nullable|url',
        ];
    }
}
