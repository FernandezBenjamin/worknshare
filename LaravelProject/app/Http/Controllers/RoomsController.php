<?php

namespace App\Http\Controllers;

use App\Sites;
use Illuminate\Http\Request;

class RoomsController extends Controller
{


    public function reserve(){

        $sites = Sites::with('rooms')->get();

        return view('user.spaces.reserve',compact(['sites']));
    }
}
