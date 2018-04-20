<?php

namespace App\Http\Controllers;

use App\Comite;
use App\Eleccion;
use Illuminate\Http\Request;


class ComiteController extends Controller
{
    public function index()
    {
        $Comite['data'] = Comite::get();
        for ($i=0; $i < count($Comite['data']); $i++) { 
            $Eleccion = Eleccion::find($Comite['data'][$i]['id_eleccion']);
            $Comite['data'][$i]['eleccion'] = $Eleccion['descripcion'];
        } 
        $Comite['foreign'] = array('eleccion' => Eleccion::get());
        return $Comite;
    }
    public function show($id)
    {
    	return Comite::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Comite::find($id)->update($request->all());
        return Comite::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Comite::find($id);
    	Comite::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Comite::create($request->all());
    }
}
