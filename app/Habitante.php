<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitante extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'nombre', 'apellido', 'casa', 'calle', 'vereda', 'sector', 'fecha_de_nacimiento', 'telefono_celular', 'telefono_habitacion', 'status'
    ];

}
