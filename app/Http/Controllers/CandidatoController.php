<?php

namespace App\Http\Controllers;

use App\Candidato;
use App\Comite;
use App\Periodo;
use App\Eleccion;
use App\Habitante;
use Illuminate\Http\Request;


class CandidatoController extends Controller
{
    public function index()
    {
        $Candidato['data'] = Candidato::get();

        for ($i=0; $i < count($Candidato['data']); $i++) { 
            $Comite = Comite::find($Candidato['data'][$i]['id_comite']);
            $Eleccion = Eleccion::find($Candidato['data'][$i]['id_eleccion']);
            $Periodo = Periodo::find($Candidato['data'][$i]['id_periodo']);
            $Habitante = Habitante::find($Candidato['data'][$i]['id_habitante']);
            $Candidato['data'][$i]['comite'] = $Comite['descripcion'];
            $Candidato['data'][$i]['periodo'] = $Periodo['fecha'];
            $Candidato['data'][$i]['eleccion'] = $Eleccion['descripcion'];

            $Candidato['data'][$i]['habitante'] = array(
                'cedula' => $Habitante['nacionalidad'] . "-" . $Habitante['cedula'],
                'nombre' => $Habitante['nombre'],
                'apellido' => $Habitante['apellido']
            );
      
        }   

        $Candidato['foreign'] = array('comite' => Comite::get(), 'periodo' => Periodo::get(), 'eleccion' => Eleccion::get(), 'habitante' => Habitante::get());
        return $Candidato;
    }

    public function show($id)
    {
    	return Candidato::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Candidato::find($id)->update($request->all());
        return Candidato::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Candidato::find($id);
    	Candidato::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Candidato::create($request->all());
    }
}
