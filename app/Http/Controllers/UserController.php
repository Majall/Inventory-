<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->type === "admin") {
            return view('admin.dashboard');
        }

        return view('dashboard');
    }
}