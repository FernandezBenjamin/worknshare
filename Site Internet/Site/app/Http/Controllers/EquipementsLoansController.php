<?php

namespace App\Http\Controllers;

use App\Equipements;
use App\EquipementsLoans;
use App\Mail\Loans;
use App\Sites;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Dirape\Token\Token;
use Illuminate\Support\Facades\Mail;

class EquipementsLoansController extends Controller
{


    public function create(){

        $sites = Sites::all();
        $equipements = Equipements::all();

        return view('user.equipement.loans',compact(['sites','equipements']));
    }


    public function getEquipementsBySites(){
        $request = [];
        $request[] = request();

        return view('user.equipement.getEquipementsBySites');
    }



    public function store(){



        $this->validate(request(), [
            'sites' => 'required|numeric',
            'equipements' => 'required|numeric',
            'reserveDate' => 'required|date',
        ]);




        $loans = EquipementsLoans::create([
            "sites_id" => request('sites'),
            "equipements_id" => request('equipements'),
            "users_id" => auth()->user()->id,
            "dateReserved" => request('reserveDate'),
            "token" =>(new Token())->Unique('equipements_loans', 'token', 255),
        ]);



        Mail::to(auth()->user())->send(new Loans(auth()->user(),$loans));



        session()->flash('message','Merci pour votre location, un email devrait vous être envoyé dans quelques minutes pour confirmer.');


        return redirect('/louer-un-equipement');

    }



    public function cancel($token){

        if (auth()->user()->getRememberToken() == $token){

        } else {
            return redirect()->home();
        }
    }
}
