<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 25/04/2018
 * Time: 17:40
 */


use App\Services;

if( isset($_GET['service_name']) && isset($_GET['short_name']) ){



    $results = Services::where('service_name','=', $_GET['service_name'])->orWhere('short_name','=',$_GET['short_name'])->get();


    echo json_encode($results);



}