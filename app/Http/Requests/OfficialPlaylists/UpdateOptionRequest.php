<?php

namespace App\Http\Requests\OfficialPlaylists;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
            'map' => 'required|string|exists:op_maps,slug',
            'variant' => 'required|string|exists:op_variants,slug',
        ];
    }
}
