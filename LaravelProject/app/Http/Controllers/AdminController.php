<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function admin(){
        return view('administration.admin');
    }


    public function getUsers(){
        return view('administration.getUsers');
    }

    public function getUsersPage(){
        $users = DB::table('users')->paginate(15);

        return view('administration.getUsers', ['users' => $users]);
    }
}
