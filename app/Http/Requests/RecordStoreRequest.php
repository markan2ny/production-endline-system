<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordStoreRequest extends FormRequest
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
            'date' => 'required',
            'operation' => 'required',
            'bundle_tag' => 'required',
            'operation' => 'required',
            'operator' => 'required',
            'qty' => 'required',
            'model_id' => 'required',
            'style' => 'required',
            'status' => 'required',

        ];
    }
}
