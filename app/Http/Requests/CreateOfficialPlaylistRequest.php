<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfficialPlaylistRequest extends FormRequest
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
            'type' => 'required|string|in:ranked,social',
            'name' => 'required|string',
            'server-name' => 'required|string',
            'message' => 'required|string|max:1000',
            'max-players' => 'required|integer|min:1|max:16',
            'vote-mode' => 'required|in:voting,veto',
            'number-of-revotes' => 'required|integer|min:0|max:99',
        ];
    }
}
