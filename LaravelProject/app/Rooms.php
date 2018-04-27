<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = ['sites_id', 'rooms_id', 'quantity'];


    public function rooms(){
        return $this->belongsToMany(Rooms::class)->select('room_name','quantity');
    }

    public function reservations(){
        return $this->belongsToMany(Rooms::class)->select('room_name','quantity');
    }
}
