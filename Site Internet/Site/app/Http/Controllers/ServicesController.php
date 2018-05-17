<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicesForm;
use App\Sites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ServicesController extends Controller
{


    public function create(){

        $sites = Sites::all();

        return view('administration.services.create',compact(['sites']));
    }

    public function getServices(){

        $request = [];
        $request[] = request();

        return view('administration.services.getServices');
    }


    public function store(Request $request, ServicesForm $form){








        $form->persist($request);

        session()->flash('message','Le service a bien été ajouter.');


        // Redirect to the homepage
        return redirect('/administration/ajouter-un-service');


    }
}
