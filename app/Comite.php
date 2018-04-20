<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'cupos', 'id_eleccion', 'seleccionable'
    ];

}
