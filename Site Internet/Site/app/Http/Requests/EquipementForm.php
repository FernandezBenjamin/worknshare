<?php

namespace App\Http\Requests;

use App\Equipements;
use App\EquipementsSites;
use App\Sites;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EquipementForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'equipement_name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_name' => 'required|string|max:40',
        ];
    }



    public function persist(Request $request){






        $equipement = Equipements::create([
            'equipement_name' => $request->get('equipement_name'),
            'description' => $request->get('description'),
            'short_name' => $request->get('short_name'),
        ]);



        $sites = Sites::all();

        $checkbox = [];


        foreach ($sites as $site){
            $checkbox[] = $request->get("checkboxSite$site->id");
        }

        for ($i = 0; $i < count($checkbox) ; $i++){
            if ($checkbox[$i] != null){
                $index = $i+1;
                $quantity = $request->get("counterSite$index");

                EquipementsSites::create([
                    'sites_id' => $index,
                    'equipements_id' => $equipement->id,
                    'quantity' => $quantity,
                ]);
            }

        }

    }
}
