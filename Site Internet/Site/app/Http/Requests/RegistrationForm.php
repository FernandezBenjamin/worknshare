<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class RegistrationForm extends FormRequest
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

        $dt = new Carbon();
        $before = $dt->subYears(13)->format('Y-m-d');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'required|date|before:'.$before,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }



    public function persist(){


        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'birthdate' => request('birthdate'),
            'address' => request('address'),
            'phone' => request('phone'),
            'password' => Hash::make(request('password')),
        ]);





        // Sign in
        auth()->login($user);


        Mail::to($user)->send(new Welcome($user));

    }
}
