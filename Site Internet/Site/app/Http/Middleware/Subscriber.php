<?php

namespace App\Http\Middleware;

use App\Subscriptions;
use Carbon\Carbon;
use Closure;

class Subscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $current_time = Carbon::now()->toDateTimeString();

        $subscription = Subscriptions::where('user_id', '=',auth()->user()->id )
            ->get()
            ->last();


        if ( (count($subscription) > 0 && $subscription->ends_at < $current_time) || auth()->user()->isAdmin == 0){
            return redirect('/sabonner');
        }

        return $next($request);
    }
}
