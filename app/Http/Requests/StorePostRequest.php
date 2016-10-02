<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests
 * @author Anatolii Ganchev <ganchclub@gmail.com>
 */
class StorePostRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['required'],
            'email' => ['email'],
            'image' => ['required', 'image'],
            'price' => ['numeric', 'max:10000'],
            'start_date' => ['required'],
            'start_time' => ['required'],
        ];
    }

}
