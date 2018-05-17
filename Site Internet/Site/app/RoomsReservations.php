<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsReservations extends Model
{
    protected $fillable = ['user_id', 'rooms_id', 'sites_id','date_reserved','start_hour','end_hour','remember_token'];




}
