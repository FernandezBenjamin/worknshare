<?php
config('app.name',"Work'n Share");
?>

@component('mail::message')

<h1>Bienvenue sur Work'n Share!</h1>
<br>

<p>
    Bonjour <b>{{ $user->first_name }}</b>,
</p>


<p>
    Nous te souhaitons la bienvenue sur à Work'n Share ! Merci de nous avoir rejoins.<br>
    <b>Tu es en route vers la super-productivité et bien plus encore !</b>
</p>


<p>
    Work'n Share a été créer dans le but d'offrir la possibilité de travailler en communauté avec une ambiance de travail cosy.
</p>


<p>
    Afin de pouvoir profiter pleinement de Work'n Share et ainsi pouvoir bénéficer de tous nos services,<br>
    il sera nécessaire de choisir un abonnement parmi ceux que nous proposons.
</p>


<p>
    Une questions ? Envoyez nous un <a href="{{config('app.url')}}/contactez-nous">email</a> ! Nous répondrons dans le plus bref délai.
</p>

@component('mail::button', ['url' => config('app.url').'/activation/'. $user->remember_token])
    Activer mon compte
@endcomponent

À très vite sur {{ config('app.name') }} !<br>
Merci,<br>
l'équipe {{ config('app.name') }}
@endcomponent
