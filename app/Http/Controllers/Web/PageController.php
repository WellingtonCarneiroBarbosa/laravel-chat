<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Returns the main page of the application
     *
     * @return void
     */
    public function welcome() {
        return view('welcome');
    }

    /**
     * Render the dashboard component
     *
     * @return void
     */
    public function dashboard() {
        return Inertia::render('Dashboard');
    }

    /**
     * Render the chat component
     *
     * @return void
     */
    public function chat() {
        return Inertia::render('Chat');
    }
}
