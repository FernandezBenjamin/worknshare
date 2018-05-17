@component('mail::message')
    Bonjour {{ $user->first_name }},

    Nous avons bien reçu votre commande pour : <b>{{ $plan->nickname }}</b>.


    Si vous souhaitez le désactiver ou changer d'offre vous pouvez le faire depuis votre espace membre,
    dans le cas ou vous avez choisi un abonnement sans engagement ou que le votre est terminé.

    Vous pouvez accéder à votre espace de gestion d'abonnement en cliquant sur ce bouton :

@component('mail::button', ['url' => config('app.url').'/abonnement'])
Mon abonnement
@endcomponent

Merci pour votre confiance,<br>
{{ config('app.name') }}
@endcomponent
