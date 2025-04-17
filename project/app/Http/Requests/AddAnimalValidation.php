<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAnimalValidation extends FormRequest
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
            'photoAnimal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|string|min:0',
            'status' => 'required|string|max:255',

        ];
    }
}
