<?php

namespace App\Http\Controllers;

use App\Cargo;

use Illuminate\Http\Request;


class CargoController extends Controller
{
    public function index()
    {
        $Cargo['data'] = Cargo::get();
        $Cargo['foreign'] = array();
        return $Cargo;
    }
    public function show($id)
    {
    	return Cargo::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Cargo::find($id)->update($request->all());
        return Cargo::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Cargo::find($id);
    	Cargo::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Cargo::create($request->all());
    }
}
