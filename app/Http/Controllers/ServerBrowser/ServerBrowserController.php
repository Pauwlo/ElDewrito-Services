<?php

namespace App\Http\Controllers\ServerBrowser;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ServerBrowserController extends Controller
{
    /**
     * Display the server browser page.
     * Fetches data from the legacy PlebBrowser API.
     * TODO: Implement local cache
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('PlebBrowser', [
            'plebBrowserApi' => config('eldewrito.plebbrowser_api'),
        ]);
    }
}
