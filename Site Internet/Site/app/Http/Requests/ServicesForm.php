<?php

namespace App\Http\Requests;

use App\Services;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class ServicesForm extends FormRequest
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
            'service_name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_name' => 'required|string|max:40',
        ];
    }



    public function persist(Request $request){



        $service = Services::create([
            'service_name' => request('service_name'),
            'description' => request('description'),
            'short_name' => request('short_name'),
        ]);


        $sites = Sites::all();

        $checkbox = [];


        foreach ($sites as $site){
            $checkbox[] = $request->get("checkboxSite$site->id");
        }

        for ($i = 0; $i < count($checkbox) ; $i++){
            if ($checkbox[$i] == null){
                $contains = 0;
            } else {
                $contains = 1;
            }
            Services::create([
                'sites_id' => $site->id,
                'services_id' => $service->id,
                'contains' => $contains,
            ]);
        }

    }
}
