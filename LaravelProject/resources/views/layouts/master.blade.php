

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Work'n Share</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Bootstrap core CSS -->
    <link href="/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>




    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">



</head>

<body>


@include('layouts.nav')

<div class="content">
    @yield('content')
</div>




@include('layouts.footer')

@include('layouts.javascript')

</body>

</html>



