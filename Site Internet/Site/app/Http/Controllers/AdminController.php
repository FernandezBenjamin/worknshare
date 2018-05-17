<?php

namespace App\Http\Controllers;

use App\Subscriptions;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Stripe\Plan;
use Stripe\Stripe;

class AdminController extends Controller
{


    public function admin(){
        $today = date('Y-m-d' );

        $tickets = DB::table('tickets')->where('created_at', 'like', '%' . $today . '%')->get();
        $rooms_reservations = DB::table('rooms_reservations')->where('created_at', 'like', '%' . $today . '%')->get();
        $subscriptions = DB::table('subscriptions')->where('created_at', 'like', '%' . $today . '%')->get();


        return view('administration.admin',compact(['tickets','rooms_reservations','subscriptions']));
    }


    public function getUsers(){
        $users = DB::table('users')
            ->where('isDeleted','=',0)
            ->simplePaginate(10);

        return view('administration.getUsers', compact(['users']));
    }


    public function getUsersDeleted(){
        $users = DB::table('users')->where('isDeleted','=',1)->simplePaginate(10);

        return view('administration.getDeleted', compact(['users']));
    }


    public function getSubscribers(){
        $users = DB::table('users')
            ->where('subscriber','=',1)
            ->simplePaginate(10);
        $subscibers = DB::table('subscriptions')
            ->where('active','=','0')
            ->orderBy('user_id', 'asc')
            ->get();


        $stripe_plan = [];

        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $plans = Plan::all();

        foreach ($plans->data as $plan){
            $stripe_plan[$plan->id] = $plan;
        }


        return view('administration.getSubscribers', compact(['users','subscibers','stripe_plan']));
    }



    public function deleteUsers($id){

        DB::table('users')
            ->where('id','=',$id)
            ->update(['isDeleted' => 1]);


        session()->flash('status','Le compte a bien été supprimés');

        return redirect('/administration/liste-des-utilisateurs');

    }

    public function reactivateUsers($id){

        DB::table('users')
            ->where('id','=',$id)
            ->update(['isDeleted' => 0]);


        session()->flash('status','Le compte a bien été réactivé.');

        return redirect('/administration/liste-des-utilisateurs-supprimes');

    }


    public function cancelSubscription($id,$user_id){

        DB::table('subscriptions')
            ->where('id','=',$id)
            ->update(['active' => 0]);

        DB::table('users')
            ->where('id','=',$user_id)
            ->update(['subscriber' => 0]);


        session()->flash('status','L\'abonnement a bien été annuler.');

        return redirect('/administration/liste-des-utilisateurs-abonnes');

    }

}
