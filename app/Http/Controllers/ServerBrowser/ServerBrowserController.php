<?php

namespace App\Http\Controllers\ServerBrowser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServerBrowserController extends Controller
{
    /**
     * Display the server browser page.
     * Fetches data from the legacy PlebBrowser API.
     * TODO: Implement local cache
     */
    public function index(Request $request): \Inertia\Response
    {
        $theme = $request->get('theme', 'plebbrowser');

        $view = match ($theme) {
            'plebbrowser' => 'PlebBrowser',
            'halo-ce' => 'HaloCE',
            default => 'PlebBrowser',
        };

        return Inertia::render("server-browser/$view", [
            'plebBrowserApi' => config('eldewrito.plebbrowser_api'),
        ]);
    }
}
