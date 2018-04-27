<?php

namespace App\Http\Controllers;

use App\Equipements;
use App\ListOfEquipements;
use App\ListOfRooms;
use App\ListOfServices;
use App\Rooms;
use App\Services;
use App\Sites;
use \Input as InputFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SitesController extends Controller
{


    public function create(){

        $services = Services::all();
        $rooms = Rooms::all();
        $equipements = Equipements::all();

        return view('administration.site.create',compact(['services','rooms','equipements']));
    }


    public function store(){

        $services = ListOfServices::all();
        $rooms = ListOfRooms::all();
        $equipements = ListOfEquipements::all();


        // Validate the form
        $validator = $this->validate(request(), [
            'city' => 'required|string|max:60',
            'hours' => 'required|string',
        ]);

        foreach($services as $service){
            $this->validate(request(), [
                $service->short_name => 'required|numeric'
            ]);
        }

        foreach($rooms as $room){
            $this->validate(request(), [
                $room->short_name => 'required|numeric'
            ]);
        }

        foreach($equipements as $equipement){
            $this->validate(request(), [
                $equipement->short_name => 'required|numeric'
            ]);
        }



        if(InputFile::hasFile('file')){

            $file = InputFile::file('file');
            $file->move('images/sites',$file->getClientOriginalName());

            $site = Sites::create([
                'city' => request('city'),
                'hours' => request('hours'),
                'filename' => $file->getClientOriginalName(),
            ]);


            foreach($services as $service){
                Services::create([
                    'id_place' => $site->id,
                    'id_service' => $service->id,
                    'contains' => request($service->short_name)->input($service->short_name),
                ]);
            }

            foreach($rooms as $room){
                Rooms::create([
                    'id_place' => $site->id,
                    'id_room' => $room->id,
                    'quantity' => request($room->short_name),
                ]);
            }

            foreach($equipements as $equipement){
                Equipements::create([
                    'id_place' => $site->id,
                    'id_equipement' => $equipement->id,
                    'quantity' => request($equipement->short_name),
                ]);
            }

        }


        return redirect('/add_new_site');

    }


    public function getSpaces(){

        $request = [];
        $request[] = request();

        return view('utils.spaces.getSpaces');
    }
}
