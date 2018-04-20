<?php

namespace App\Http\Controllers;

use App\Voto;

use Illuminate\Http\Request;


class VotoController extends Controller
{
    public function index()
    {
        $Voto['data'] = Voto::get();
        $Voto['foreign'] = array();
        return $Voto;
    }

    public function show($id)
    {
    	return Voto::find($id);
        
    }
 	public function update(Request $request, $id) {
 		Voto::find($id)->update($request->all());
        return Voto::find($id);
 	}
    public function destroy($id)
    {
    	$obj = Voto::find($id);
    	Voto::find($id)->delete();
    	return $obj;
    }
    public function store(Request $request)  {
    	return Voto::create($request->all());
    }
}
