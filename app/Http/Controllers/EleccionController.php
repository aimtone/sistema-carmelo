<?php

namespace App\Http\Controllers;

use App\Eleccion;

use Illuminate\Http\Request;


class EleccionController extends Controller
{
    public function index()
    {
        $Eleccion['data'] = Eleccion::get();
        $Eleccion['foreign'] = array();
        return $Eleccion;
    }
    public function show($id)
    {
    	return Eleccion::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Eleccion::find($id)->update($request->all());
        return Eleccion::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Eleccion::find($id);
    	Eleccion::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Eleccion::create($request->all());
    }
}
