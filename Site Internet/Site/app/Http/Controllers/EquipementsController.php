<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipementForm;
use App\Sites;
use Illuminate\Http\Request;

class EquipementsController extends Controller
{
    public function create(){

        $sites = Sites::all();

        return view('administration.equipements.create',compact(['sites']));
    }

    public function getEquipements(){

        $request = [];
        $request[] = request();

        return view('administration.equipements.getEquipements');
    }


    public function store(Request $request, EquipementForm $form){


        $form->persist($request);

        session()->flash('message','L\'équipement a bien été ajouter.');


        return redirect('/administration/ajouter-un-equipement');


    }
}
