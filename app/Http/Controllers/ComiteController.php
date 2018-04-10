<?php

namespace App\Http\Controllers;

use App\Comite;

use Illuminate\Http\Request;


class ComiteController extends Controller
{
    public function index()
    {
        $Comite['data'] = Comite::get();
        $Comite['foreign'] = array();
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
