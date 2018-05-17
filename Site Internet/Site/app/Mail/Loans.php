<?php

namespace App\Mail;

use App\EquipementsLoans;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Loans extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;
    /**
     * @var EquipementsLoans
     */
    public $loans;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user, EquipementsLoans $loans)
    {

        $this->user = $user;
        $this->loans = $loans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Nous confirmons votre location d\'équipement !')
            ->markdown('user.email.loan');
    }
}
