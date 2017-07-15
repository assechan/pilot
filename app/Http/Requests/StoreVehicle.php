<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class StoreVehicle extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'vehicle_types_id' => 'required',
        'plateNumber' => 'required| max:20|min:2|unique:vehicles|alpha_dash',
        'model' => 'required| max:20|min:2|regex:/^[\p{L}\p{N} .-]+$/',
        'dateRegistered' => 'required',
        ];


     
    }

    public function messages()
    {
        return [
        'vehicle_types_id.required' => 'Please choose a vehicle type.',
        ];

    }

    //Overriding the response 422
    public function response(array $errors)
    {
        return Response::make(json_encode($errors), 200);
    }

}
