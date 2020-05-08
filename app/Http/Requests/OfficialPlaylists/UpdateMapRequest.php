<?php

namespace App\Http\Requests\OfficialPlaylists;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMapRequest extends FormRequest
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
        $id = $this->map->id;

        return [
            'display-name' => 'required|string',
            'file-name' => "required|string|unique:op_maps,file_name,$id",
        ];
    }
}
