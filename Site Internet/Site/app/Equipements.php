<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipements extends Model
{
    protected $fillable = ['equipement_name', 'description', 'short_name'];

}
