<?php

namespace App\Http\Controllers;

use App\Mail\Subscription;
use App\Subscriptions;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error\Card;
use Stripe\Plan;
use Stripe\Stripe;

class SubscriptionsController extends Controller
{
    


    public function show($offer,$engagement = null){

        $plans = $this->retrievePlan($offer,$engagement);

        return view('user.subscription.subscribe', compact(['offer','engagement','plans']));
    }



    public function retrievePlan($offer,$engagement){
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $plans = null;

        if ($offer == 2 && $engagement == 0){
            $plans = Plan::retrieve('simple-without-engagement');
        } elseif ($offer == 2 && $engagement == 1){
            $plans = Plan::retrieve('simple-with-engagement');
        } elseif ($offer == 3 && $engagement == 0){
            $plans = Plan::retrieve('resident-without-engagement');
        } elseif ($offer == 3 && $engagement == 1){
            $plans = Plan::retrieve('resident-with-engagement');
        }

        return $plans;
    }

    public function createStripePlan(){
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        Plan::create([
            "amount" => 30000,
            "interval" => "month",
            "product" => [
                "name" => "Abonnement Résident Sans Engagement"
            ],
            "nickname" => "Abonnement Résident Sans Engagement",
            "currency" => "eur",
            "id" => "resident-without-engagement"
        ]);

        Plan::create([
            "amount" => 28000,
            "interval" => "month",
            "product" => [
                "name" => "Abonnement Résident Avec Engagement 8 mois"
            ],
            "nickname" => "Abonnement Résident Avec Engagement 8 mois",
            "currency" => "eur",
            "id" => "resident-with-engagement"
        ]);

        Plan::create([
            "amount" => 2400,
            "interval" => "month",
            "product" => [
                "name" => "Abonnement Simple Sans Engagement"
            ],
            "nickname" => "Abonnement Simple Sans Engagement",
            "currency" => "eur",
            "id" => "simple-without-engagement"
        ]);


        Plan::create([
            "amount" => 2000,
            "interval" => "month",
            "product" => [
                "name" => "Abonnement Simple Avec Engagement 12 mois"
            ],
            "nickname" => "Abonnement Simple Avec Engagement 12 mois",
            "currency" => "eur",
            "id" => "simple-with-engagement"
        ]);




    }





    public function subscribe(Request $request){



        $token = $request->stripeToken;
        $user = auth()->user();


        if($request->formule == 2 && $request->engagement == 1){
            $myDate = date('Y-m-d H:i:s', strtotime('+12 month'));

            $user->newSubscription('simple-with-engagement','simple-with-engagement')->withCoupon($request->coupon)->create($token);
        } else if($request->formule == 2  && $request->engagement == 0){
            $myDate = date('Y-m-d H:i:s', strtotime('+1 month'));

            $user->newSubscription('simple-without-engagement','simple-without-engagement')->withCoupon($request->coupon)->create($token);
        } else if($request->formule == 3 && $request->engagement == 1){
            $myDate = date('Y-m-d H:i:s', strtotime('+8 month'));

            $user->newSubscription('resident-with-engagement','resident-with-engagement')->withCoupon($request->coupon)->create($token);
        } else if($request->formule == 3  && $request->engagement == 0){
            $myDate = date('Y-m-d H:i:s', strtotime('+1 month'));
            $user->newSubscription('resident-without-engagement','resident-without-engagement')->withCoupon($request->coupon)->create($token);
        }



        DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first()
            ->update(['ends_at' => $myDate])
            ->update(['active' => true]);


        return redirect()->home();
    }


    public function getAll(){
        return view('user.subscription.subscribeOffer');
    }



    public function showClient(){
        $subscribers = Subscriptions::
            where('user_id', '=', auth()->user()->id)
            ->where('active','=',true)
            ->first();



        if(isset($subscribers)){


            Stripe::setApiKey(Config::get('services.stripe.secret'));

            $plan = Plan::retrieve($subscribers->name);
            if (strpos($subscribers->name,'with-engagement') !== false){
                $status = 'Vous avez choisi votre abonnement avec engagement. Vous devez donc attendre la fin de votre engagement avant de changer d\'offre';
                return view('user.subscription.mySubscription', compact(['subscribers','plan','status']));

            }

        } else {
            $plan = "";
        }


        return view('user.subscription.mySubscription', compact(['subscribers','plan']));




    }



    public function change($token){
        if(auth()->user()->getRememberToken() == $token){

            $subscribers = Subscriptions::
            where('user_id', '=', auth()->user()->id)
                ->where('active','=',1)
                ->first();




            if(isset($subscribers)){


                Stripe::setApiKey(Config::get('services.stripe.secret'));

                $plan = Plan::retrieve($subscribers->name);

            } else {
                $plan = "";
            }

            return view('user.subscription.change', compact(['subscribers','plan']));
        }

        return redirect()->home();
    }

    public function changeOffer($token,$offer,$engagement = null){
        $subscribers = Subscriptions::
        where('user_id', '=', auth()->user()->id)
            ->where('active','=',1)
            ->first();


        if (strpos($subscribers->name,'with-engagement') === false){

            Stripe::setApiKey(Config::get('services.stripe.secret'));

            $plans = null;

            if ($offer == 2 && $engagement == 0){
                $plans = Plan::retrieve('simple-without-engagement');
            } elseif ($offer == 2 && $engagement == 1){
                $plans = Plan::retrieve('simple-with-engagement');
            } elseif ($offer == 3 && $engagement == 0){
                $plans = Plan::retrieve('resident-without-engagement');
            } elseif ($offer == 3 && $engagement == 1){
                $plans = Plan::retrieve('resident-with-engagement');
            }


            return view('user.subscription.changeOffer', compact(['token','offer','engagement','plans']));

        } else {
            $status = 'Vous avez choisi votre abonnement avec engagement. Vous devez donc attendre la fin de votre engagement avant de changer d\'offre';
            return view('user.subscription.mySubscription', compact(['subscribers','plan','status']));
        }



    }




    public function storeNewOffer($token,Request $request){

        if(auth()->user()->getRememberToken() == $token) {



            $token = $request->stripeToken;
            $user = auth()->user();


            if($request->formule == 2 && $request->engagement == 1){
                $myDate = date('Y-m-d H:i:s', strtotime('+12 month'));

            } else if($request->formule == 2  && $request->engagement == 0){
                $myDate = date('Y-m-d H:i:s', strtotime('+1 month'));

            } else if($request->formule == 3 && $request->engagement == 1){
                $myDate = date('Y-m-d H:i:s', strtotime('+8 month'));

            } else if($request->formule == 3  && $request->engagement == 0){
                $myDate = date('Y-m-d H:i:s', strtotime('+1 month'));
            }


            $plan = $this->retrievePlan($request->formule,$request->engagement);


            $user->newSubscription($plan->id,$plan->id)->withCoupon($request->coupon)->create($token);


            DB::table('subscriptions')
                ->where('user_id', $user->id)
                ->update(['active' => 0]);


            Subscriptions::where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->first()
                ->update([
                    'active' => 1,
                    'ends_at' => $myDate
                ]);



            $subscribers = Subscriptions::
            where('user_id', '=', auth()->user()->id)
                ->where('active','=',1)
                ->first();



            Mail::to($user)->send(new Subscription($user,$plan));


            $succes = 'Votre demande de nouvel abonnement a bien été pris en compte. Cela devrait prendre effet dans quelques minutes.';
            return view('user.subscription.mySubscription', compact(['subscribers','plan','succes']));

        } else {
            return redirect()->home();
        }
    }



    public function cancelPage($token,Request $request){
        if(auth()->user()->getRememberToken() == $token) {

            return view('user.subscription.cancelPage', compact(['token']));

        } else {
            return redirect()->home();
        }
    }


    public function cancel($token, Request $request){
        if(auth()->user()->getRememberToken() == $token) {

            if($request->cancel == 1){
                $subscribers = Subscriptions::
                where('user_id', '=', auth()->user()->id)
                    ->where('active','=',1)
                    ->first();


                if (strpos($subscribers->name,'with-engagement') === false) {
                    DB::table('subscriptions')
                        ->where('user_id', auth()->user()->id)
                        ->update(['active' => 0]);

                    User::where('id', auth()->user()->id)
                        ->update(['subscriber' => 0]);

                    return redirect('/abonnement');
                } else {
                    return redirect('/abonnement');
                }

            } else {
                return redirect()->home();
            }

        } else {
            return redirect()->home();
        }
    }



}



