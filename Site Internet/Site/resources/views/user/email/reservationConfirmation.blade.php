@component('mail::message')


    <?php
        setlocale(LC_TIME, "fr_FR", "French");
        $date = strftime("%d %B %Y", strtotime($reservation->date_reserved));
    ?>
<p>
    Bonjour <b>{{ $user->first_name }}</b>,
</p>

<p>
    Nous confirmons bien votre réservation pour le {{ $date }} de {{ strftime("%H:%M", strtotime($reservation->start_hour) ) }} à {{ strftime("%H:%M", strtotime($reservation->end_hour) ) }}.
</p>


<p>
    Si vous souhaitez annuler, vous avez jusqu'à 24h avant la réservation pour le faire en suivant ce lien :
</p>

@component('mail::button', ['url' => config('app.url').'/annuler-reservation/'. $reservation->remember_token])
    Annuler ma réservation
@endcomponent

<p>
    Toutefois si la réservation ne vient pas de vous, merci de contacter au plus vite notre équipe.
</p>


<p>
    En vous remerciant par avance, nous vous adressons, Madame/Monsieur, nos salutations distinguées,
</p>

À très vite sur {{ config('app.name') }} !<br>
Merci,<br>
l'équipe {{ config('app.name') }}
@endcomponent
