<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('tampilan_awal');
    //     // return view('home');
    // }

    public function tampilan_awal()
    {
        return view('tampilan_awal');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

}
