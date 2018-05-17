<?php

namespace App\Http\Requests;

use App\Mail\ReservationConfirmation;
use App\RoomsReservations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReservationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sites' => 'required|numeric',
            'rooms' => 'required|numeric',
            'reserveDate' => 'required|date',
            'reservationStart' => 'required|date_format:H:i',
            'reservationEnd' => 'required|date_format:H:i',
        ];
    }


    public function persist(){


        $user = auth()->user();


        $token = new UUID;

        $token = $token->limit(100);

        $reservation = RoomsReservations::create([
            'user_id' => $user->id,
            'sites_id' => request('sites'),
            'rooms_id' => request('rooms'),
            'date_reserved' => request('reserveDate'),
            'start_hour' => request('reservationStart'),
            'end_hour' => request('reservationEnd'),
            'remember_token' => $token,
        ]);



        Mail::to($user)->send(new ReservationConfirmation($user,$reservation));

    }
}
