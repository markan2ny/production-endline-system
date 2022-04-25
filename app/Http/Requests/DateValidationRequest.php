<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateValidationRequest extends FormRequest
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
            'fromdate' => 'required|date',
            'todate' => 'required|date|after_or_equal:fromdate'
        ];
    }
}
