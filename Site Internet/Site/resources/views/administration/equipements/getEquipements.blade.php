<?php
/**
 * Created by PhpStorm.
 * User: benjaminfernandez
 * Date: 25/04/2018
 * Time: 17:40
 */


use App\Equipements;

if( isset($_GET['equipement_name']) && isset($_GET['short_name']) ){



    $results = Equipements::where('equipement_name','=', $_GET['equipement_name'])->orWhere('short_name','=',$_GET['short_name'])->get();


    echo json_encode($results);



}