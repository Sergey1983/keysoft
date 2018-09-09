<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;



class SearchValidate extends FormRequest
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

        $fields = ['id', 'name', 'description', 'shop_id'];

        foreach ($fields as $field) {
            
            $rules[$field] = 'required_without_all:'.implode(',', (array_diff($fields, [$field])));
        }

        return $rules;

        // return ['id' => 'required'];
    }


    public function messages()

    {

        return ['*.required_without_all' => 'Нужно ввести хотя бы одно поле'];
    }
}
