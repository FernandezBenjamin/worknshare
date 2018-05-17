<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 25/04/2018
 * Time: 17:40
 */


use App\RoomsReservations;
use App\RoomsSites;

if( isset($_GET['date']) && isset($_GET['room_id']) && isset($_GET['site_id']) && isset($_GET['start']) && isset($_GET['end']) ){

    $start = strtotime( $_GET['start'].":00:00" );
    $end = strtotime( $_GET['end'].":00:00" );
    $dateStart = date('H:i:s', $start);
    $dateEnd = date('H:i:s', $end);


    $conditions = [
        ['date_reserved','=', $_GET['date']],
        ['sites_id','=', $_GET['site_id']],
        ['rooms_id','=', $_GET['room_id']],
    ];


    $results = RoomsReservations::where($conditions)
        ->whereBetween('start_hour',[$dateStart,$dateEnd])
        ->whereBetween('end_hour',[$dateStart,$dateEnd])
        ->get();

    $result['countBetween'] = count($results);


    $results = RoomsReservations::where($conditions)
        ->whereNotBetween('start_hour',[$dateStart,$dateEnd])
        ->whereNotBetween('end_hour',[$dateStart,$dateEnd])
        ->get();

    $result['countNotBetween'] = count($results);

    $quantity = RoomsSites::where('sites_id',$_GET['site_id'])->where('rooms_id',$_GET['room_id'])->get();

    $result['quantity'] = $quantity[0]['quantity'];

    echo json_encode($result);



}





