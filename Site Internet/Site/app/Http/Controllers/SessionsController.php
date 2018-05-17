<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

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


    public function store(Request $request){


        if (! auth()->attempt( request( ['email','password'] ) ) ){
            return back()->withErrors([
                "message" => "Veuillez vérifier vos informations de connexion et réessayez."
            ]);
        }

        if( auth()->user()->isConfirmed == 0) {
            auth()->logout();
            return redirect('/activer-le-compte');
        }


        return redirect()->back();


    }


    public function destroy(){
        auth()->logout();

        return redirect()->home();
    }

    public function changePasswordPage(){
        return view('user.sessions.passwords.email');
    }


    public function changePassword(){
        return view('user.sessions.passwords.email');
    }


    public function passwordRequest($token){
        if (auth()->user()->getRememberToken() == $token){
            auth()->logout();

            return redirect('/mot-de-passe/email');
        }
        return redirect()->home();

    }
}
