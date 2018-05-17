<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesReservations extends Model
{
    protected $fillable = ['users_id', 'services_id', 'sites_id', 'date_reserve','token','canceled'];
}
