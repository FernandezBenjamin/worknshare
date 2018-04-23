<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{


    /**
     * SessionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create(){
        return view('user.sessions.create');
    }


    public function store(){

        if (! auth()->attempt( request( ['email','password'] ) ) ){
            return back()->withErrors([
                "message" => "Veuillez vérifier vos informations de connexion et réessayez."
            ]);
        }

        return redirect()->home();

    }


    public function destroy(){
        auth()->logout();

        return redirect()->home();
    }
}
