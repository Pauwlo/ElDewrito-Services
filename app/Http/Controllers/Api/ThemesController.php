<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateThemeRequest;

class ThemesController extends Controller
{
    /**
     * Update the user theme in storage.
     *
     * @param  \App\Http\Requests\UpdateThemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThemeRequest $request)
    {
        $theme = request('id');

        if (auth()->check()) {
            $user = auth()->user()->update([
                'theme' => $theme,
            ]);

            return response(null, 204);
        }

        $cookie = cookie('theme', $theme, 44640);

        return response(null, 204)->cookie($cookie);
    }
}
