<?php

namespace App\Http\Requests\OfficialPlaylists;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaylistRequest extends FormRequest
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
            'name' => 'required|string',
            'server-name' => 'required|string',
            'message' => 'required|string|max:1000',
            'max-players' => 'required|integer|min:1|max:16',
            'vote-mode' => 'required|in:voting,veto',
            'number-of-revotes' => 'required|integer|min:0|max:99',
        ];
    }
}
