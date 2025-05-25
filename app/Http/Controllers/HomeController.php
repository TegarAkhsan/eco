<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function about()
    {
        return view('about');
    }

    public function report()
    {
        return view('report');
    }

    public function map()
    {
        return view('map');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function collaboration()
    {
        return view('collaboration');
    }
}
