@component('mail::message')


    Bonjour {{ $user->first_name }},

    Nous avons bien reçu votre demande de location.



    Pour annuler la location vous pouvez cliquer sur ce bouton :

@component('mail::button', ['url' => config('app.url').'/annuler-location/'. $loans->token])
Annuler ma réservation
@endcomponent

Merci pour votre confiance,<br>
{{ config('app.name') }}
@endcomponent
