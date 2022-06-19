<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

class LogoutController extends Controller
{
    /**
     * Log out from session.
     * @return Redirector
     */
    public function execute()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
