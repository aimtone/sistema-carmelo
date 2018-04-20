<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activacion extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guid', 'id_periodo'
    ];

}
