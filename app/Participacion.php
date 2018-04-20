<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_habitante', 'id_periodo'
    ];

}
