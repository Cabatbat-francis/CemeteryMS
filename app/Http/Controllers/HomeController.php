<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burial;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $burials = Burial::all();
        $corpses = array();
        if(Auth::check())
            $corpses = auth()->user()->Corpses->all();
        return view('home', compact('burials', 'corpses'));
    }
}
