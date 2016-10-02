<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests
 * @author Anatolii Ganchev <ganchclub@gmail.com>
 */
class Request extends FormRequest
{

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.required' => 'Загрузите фото для события',
            'title.required' => 'Заголовок не может быть пустым',
            'description.required' => 'Описание слишком короткое',
            'email.email' => 'Email введен неверно',
            'image.mimes' => 'Формат картинки не поддерживается',
            'price.numeric' => 'Цена введена неверно',
            'start_date.required' => 'Укажите дату начала события',
            'start_time.required' => 'Укажите время начала события',
        ];
    }
}