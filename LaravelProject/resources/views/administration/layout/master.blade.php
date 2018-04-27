<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 06/03/2018
 * Time: 17:45
 */


?>


        <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Work'n Share | Administration</title>
    <!-- Bootstrap core CSS-->
    <link href="/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">


@extends('administration.layout.nav')


<div class="content">
    @yield('content')
</div>


@extends('administration.layout.footer')



</div>
</body>

</html>
