<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipementsLoans extends Model
{
    protected $fillable = ['sites_id', 'equipements_id', 'users_id','dateReserved','token','cancel'];
}
