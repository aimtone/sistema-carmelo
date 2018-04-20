<?php

namespace App\Http\Controllers;

use App\Participacion;
use App\Habitante;
use Illuminate\Http\Request;


class ParticipacionController extends Controller
{
    public function index()
    {
        $Participacion['data'] = Participacion::get();

        for ($i=0; $i < $Participacion['data']->count(); $i++) { 
            # code...
            $Participacion['data'][$i]['habitante'] = habitante::find($Participacion['data'][$i]['id_habitante']);
        }
        
        $Participacion['foreign'] = array('habitante'=>habitante::get());
        return $Participacion;
    }
    public function show($id)
    {
    	return Participacion::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Participacion::find($id)->update($request->all());
        return Participacion::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Participacion::find($id);
    	Participacion::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Participacion::create($request->all());
    }
}
