<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;
class StoreBrokerageStatusType extends FormRequest
{
     public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'description' => 'required| max:20|min:3|unique:brokerage_status_types|regex:/^[\p{L}\p{N} .-]+$/',
        ];
    }

    //Overriding the response 422
    public function response(array $errors)
    {
        return Response::make(json_encode($errors), 200);
    }
}
