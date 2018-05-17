<?php

namespace App\Mail;

use App\RoomsReservations;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, RoomsReservations $reserve)
    {
        $this->user = $user;

        $this->reservation = $reserve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Votre réservation est bien confirmé !')
            ->markdown('user.email.reservationConfirmation');
    }
}
