<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function room()
    {
        return view('admin.room');
    }

    public function device()
    {
        return view('admin.device');
    }

    public function chat()
    {
        return view('admin.chat');
    }

    public function user()
    {
        return view('admin.user');
    }

    public function support()
    {
        return view('admin.support');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
