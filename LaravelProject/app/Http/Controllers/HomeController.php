<?php

namespace App\Http\Controllers;



use App\Sites;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Sites::with(['equipements','services','rooms'])->get();


        return view('home.homepage', compact(['sites']));
    }
}
