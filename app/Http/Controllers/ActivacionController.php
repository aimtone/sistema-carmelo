<?php

namespace App\Http\Controllers;

use App\Activacion;

use Illuminate\Http\Request;


class ActivacionController extends Controller
{
    public function index()
    {
        $Activacion['data'] = Activacion::get();
        $Activacion['foreign'] = array();
        return $Activacion;
    }
    public function show($id)
    {
    	return Activacion::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Activacion::find($id)->update($request->all());
        return Activacion::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Activacion::find($id);
    	Activacion::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Activacion::create($request->all());
    }
}
