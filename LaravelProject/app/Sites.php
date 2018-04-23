<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $fillable = ['city', 'hours'];


    public function equipements(){
        return $this->belongsToMany(Equipements::class)->select('equipement_name','quantity');
    }


    public function rooms(){
        return $this->belongsToMany(Rooms::class)->select('room_name','quantity');
    }

    public function services(){
        return $this->belongsToMany(Services::class);
    }
}
