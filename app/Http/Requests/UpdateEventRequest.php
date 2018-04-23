<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'time' => 'required',
            'contact' => 'required',
            'venue' => 'required',
            'type' => 'required|in:sport,culture,other',
            'thumbnail_path' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
