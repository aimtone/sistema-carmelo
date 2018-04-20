<?php

namespace App\Http\Controllers;

use App\Habitante;
use App\Cargo;
use Illuminate\Http\Request;


class HabitanteController extends Controller
{
    public function index()
    {
        $Habitante['data'] = Habitante::get();
        $Habitante['foreign'] = array();
    	return $Habitante;
    }
    public function show($id)
    {
    	return Habitante::find($id);
    }
 	public function update(Request $request, $id) {
 		Habitante::find($id)->update($request->all());
        return Habitante::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Habitante::find($id);
    	Habitante::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Habitante::create($request->all());
    }
}
