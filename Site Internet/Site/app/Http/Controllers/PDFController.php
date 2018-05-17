<?php

namespace App\Http\Controllers;

use App\Subscriptions;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Stripe\Plan;
use Stripe\Stripe;

class PDFController extends Controller
{


    public function getReceipt(){


        $user = auth()->user();

        $subscriptions = Subscriptions::
        where('user_id', '=', $user->id)
            ->get();


        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $plan = Plan::all()->data;
        $plans = [];


        foreach ($plan as $item){
            $plans[$item->id] = $item;
        }




        $pdf = PDF::loadView('user.receipt.receipt',
            [
                'user' => $user,
                'subscriptions' => $subscriptions,
                'plans' => $plans
            ]);


        $date = date("Y_m_d");
        $date = (string) $date;
        $filename = "facture_$date\_$user->first_name\_$user->last_name";

        return $pdf->download($filename);
    }
}
