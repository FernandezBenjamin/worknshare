<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{



    public function edit(){

        $user = User::find(auth()->user()->id);

        return view('user.editProfil', compact('user'));
    }


}
