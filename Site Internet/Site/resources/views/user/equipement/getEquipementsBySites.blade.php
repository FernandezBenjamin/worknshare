<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 25/04/2018
 * Time: 17:40
 */


use App\EquipementsLoans;
use App\EquipementsSites;

if( isset($_GET['equipements_id']) && isset($_GET['sites_id']) && isset($_GET['date']) ){



    $result = EquipementsSites::where('equipements_id','=', $_GET['equipements_id'])
        ->where('sites_id','=',$_GET['sites_id'])
        ->first();

    $results['equipements_sites'] = $result;

    $loans = EquipementsLoans::where('equipements_id','=', $_GET['equipements_id'])
        ->where('sites_id','=',$_GET['sites_id'])
        ->where('dateReserved','=',$_GET['date'])
        ->get();

    $results['equipements_loans'] = $loans;


    echo json_encode($results);



}