<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function gitpull()
    {
        shell_exec("cd C:\\xampp\htdocs\qlgd");
        shell_exec("git pull");
        return view('home');
    }
}
