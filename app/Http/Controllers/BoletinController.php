<?php

namespace App\Http\Controllers;
use App\Candidato;
use App\Periodo;
use App\Habitante;
use App\Eleccion;
use App\Comite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BoletinController extends Controller
{
    
    public function index($guid) {
    	$Periodo = Periodo::where('guid', '=', $guid)->get();
    	$Periodo = $Periodo[0];
    	$Eleccion = Eleccion::find($Periodo['id_eleccion']);
    	$Comite = Candidato::select('id_comite')->where('id_eleccion', '=', $Periodo['id_eleccion'])->groupBy('id_comite')->get();
    	for ($i=0; $i < $Comite->count(); $i++) { 
    		$Comite[$i]['comite'] = Comite::find($Comite[$i]['id_comite']);
    		$Comite[$i]['candidatos'] = Candidato::where('id_eleccion', '=', $Periodo['id_eleccion'])->where('id_comite', '=', $Comite[$i]['id_comite'])->get();

    		for ($j=0; $j < $Comite[$i]['candidatos']->count(); $j++) { 
    			# code...
    			$Comite[$i]['candidatos'][$j]['habitante'] = Habitante::find($Comite[$i]['candidatos'][$j]['id_habitante']);

    		}
    	}
    	$Periodo['eleccion'] = $Eleccion;
    	$Periodo['comite'] = $Comite;
    	return $Periodo;
    }

    public function resultados($id) {

        return DB::select(DB::raw("SELECT p.fecha, CONCAT(h.nacionalidad, '-', h.cedula) as cedula, CONCAT(h.nombre, ' ', h.apellido) as nombre_completo, co.descripcion as comite, count(*) as resultado FROM ((((votos as v INNER JOIN periodos as p ON v.id_periodo = p.id) INNER JOIN candidatos as c ON v.id_candidato = c.id) INNER JOIN habitantes as h ON c.id_habitante = h.id) INNER JOIN comites as co ON v.id_comite = co.id) WHERE p.id = 4 GROUP BY nombre_completo, comite ORDER BY comite, resultado DESC"));

    }
}
