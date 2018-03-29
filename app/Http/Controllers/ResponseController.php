<?php

namespace App\Http\Controllers;

use App\Response;

use Illuminate\Http\Request;


class ResponseController extends Controller
{
 
    public function index()
    {
    	return Response::get();
    
    }
 
    public function show($id)
    {
    	return Response::find($id);
        
    }
 	
 	public function update(Request $request, $id) {
 		Response::find($id)->update($request->all());
        return Response::find($id);
 	}

    public function destroy($id)
    {
    	$obj = Response::find($id);
    	Response::find($id)->delete();
    	return $obj;
    }
 
    public function store(Request $request)  {
    	return Response::create($request->all());
    }
 
}
