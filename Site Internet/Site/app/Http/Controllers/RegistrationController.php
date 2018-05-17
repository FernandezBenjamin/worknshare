<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\RoomsReservations;
use App\User;

class RegistrationController extends Controller
{



    public function create(){
        return view('user.registration.create');
    }


    public function store(RegistrationForm $form){


        $form->persist();

        session()->flash('message','Merci de votre inscription, un email devrait vous être envoyé dans quelques minutes.');


        // Redirect to the homepage
        return redirect()->home();


    }



    public function activate($token){
        $user = User::where('remember_token', '=', $token)->get();

        if( count($user) == 1 ){
            User::where('remember_token', '=', $token)->update(['isConfirmed' => 1]);
            return view('user.registration.activate');
        } else {
            return view('errors.token_error');
        }
    }



    public function activateLink(){
        return view('errors.activate');
    }
}
