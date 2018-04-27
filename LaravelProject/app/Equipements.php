<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipements extends Model
{
    protected $fillable = ['sites_id', 'equipements_id', 'quantity'];

}
