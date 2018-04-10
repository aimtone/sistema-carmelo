<?php

namespace App\Http\Controllers;

use App\Periodo;
use App\Eleccion;
use Illuminate\Http\Request;


class PeriodoController extends Controller
{
    public function index()
    {
        $Periodo['data'] = Periodo::get();
        for ($i=0; $i < count($Periodo['data']); $i++) { 
            $Eleccion = Eleccion::find($Periodo['data'][$i]['id_eleccion']);
            $Periodo['data'][$i]['eleccion'] = $Eleccion['descripcion'];

            $fecha_actual = strtotime(date("d-m-Y",time()));
            $fecha_entrada = strtotime($Periodo['data'][$i]['fecha']);

            if($fecha_actual == $fecha_entrada) {
                $Periodo['data'][$i]['botones'] = 1;
            } else  {
                $Periodo['data'][$i]['botones'] = 0;
            }
        } 
        $Periodo['foreign'] = array('eleccion' => Eleccion::get(),);
        return $Periodo;
    }
    public function show($id)
    {
    	return Periodo::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Periodo::find($id)->update($request->all());
        return Periodo::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Periodo::find($id);
    	Periodo::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Periodo::create($request->all());
    }
}
