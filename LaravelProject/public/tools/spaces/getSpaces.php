<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 25/04/2018
 * Time: 17:40
 */


use App\Reservations;

if( isset($_GET['date']) && isset($_GET['room_id']) && isset($_GET['site_id'])){

    $results = Reservations::where('date_reserve', $_GET['date'])->where('sites_id',$_GET['site_id'])->where('rooms_id',$_GET['room_id']);

    echo $results;
}


