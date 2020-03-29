<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;

class ThemeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $theme = $this->getTheme();

        $view->with('theme', $theme);
    }

    /**
     * Determine the active theme based on user authentication or cookie.
     * 
     * @return int|string
     */
    private function getTheme()
    {
        if (auth()->check())
            return auth()->user()->theme;
        
        return Cookie::get('theme') ?? 1;
    }
}
