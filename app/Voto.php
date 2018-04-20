<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guid', 'id_periodo', 'id_candidato', 'id_comite'
    ];

}
