<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KejadianRequest extends FormRequest
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
            'nama_kejadian' => 'required',
            'poin_kejadian' => 'required|numeric',
            'tipe_kejadian' => 'required',
        ];
    }
}
