<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationForm;
use App\RoomsReservations;
use App\Services;
use App\ServicesReservations;
use App\ServicesSites;
use App\Sites;
use Dirape\Token\Token;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{



    public function getSpaces(){
        return view('user.spaces.getSpaces');
    }


    public function getHours(){
        return view('user.spaces.getHours');
    }


    public function reserve(){

        $sites = Sites::with('rooms')->get();

        return view('user.spaces.reserve',compact(['sites']));
    }


    public function store(ReservationForm $form){
        $form->persist();

        session()->flash('message','Merci pour votre réservation, un email devrait vous être envoyé dans quelques minutes.');


        // Redirect to the homepage
        return redirect('/reserver-un-espace');
    }

    public function cancel($token){
        $reservation = RoomsReservations::where('remember_token', '=', $token)
            ->where('users_id','=',auth()->user()->id)
            ->get();

        if( count($reservation) == 1){
            $reservation->update(['canceled' => 1]);
        } else {
            return view('errors.token_error');
        }
    }



    public function reservePlateau(){


        $serviceSite = Sites::with('services')->get();



        $sites = [];
        foreach ($serviceSite as $site){

            if (in_array(["short_name" => "member_tray"], (array)$site) && $site->services[1]->contains == 1) {
                $sites[] = $site;
            }
        }

        $date = date('Y-m-d', strtotime(" +1 day"));
        $reservation = ServicesReservations::where('users_id','=',auth()->user()->id)
            ->where('date_reserve','>=',$date)
            ->where('canceled','=',0)
            ->first();


        return view('user.member_tray',compact(['sites','reservation']));
    }



    public function storePlateau(){



        $this->validate(request(), [
            'sites' => 'required|numeric',
            'reserveDate' => 'required|date',
        ]);

        $reservation = ServicesReservations::where('users_id','=',auth()->user()->id)
            ->where('date_reserve','>=',request('reserveDate'))
            ->first();


        if (count($reservation) == 0){
            $reservation = ServicesReservations::create([
                "users_id" => auth()->user()->id,
                "services_id" => 2,
                "sites_id" => request('sites'),
                "date_reserve" => request('reserveDate'),
                "token" =>(new Token())->Unique('equipements_loans', 'token', 100),
            ]);
        } else {

            ServicesReservations::where('token', '=', $reservation->token)
                ->where('users_id','=',auth()->user()->id)
                ->update(['canceled' => 0]);
        }



        return redirect('/commander-un-plateau-repas');
    }



    public function cancelPlateau($token){
        $reservation = ServicesReservations::where('token', '=', $token)
        ->where('users_id','=',auth()->user()->id)
        ->get();

        if( count($reservation) == 1 ){
            ServicesReservations::where('token', '=', $token)
                ->where('users_id','=',auth()->user()->id)
                ->update(['canceled' => 1]);

            session()->flash('status','Votre annulation a bien été prise en compte.');



            return redirect('/commander-un-plateau-repas');
        } else {
            return view('errors.token_error');
        }
    }



    public function showAll(){


        $date = date('Y-m-d');

        $services = ServicesReservations::where('users_id','=',auth()->user()->id)
            ->where('date_reserve','>=',$date)
            ->get();


        $rooms = RoomsReservations::where('user_id','=',auth()->user()->id)
            ->where('date_reserved','>=',$date)
            ->get();




        return view('user.reservation',compact(['services','rooms']));
    }


}