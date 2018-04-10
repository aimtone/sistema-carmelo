<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
 
    public function index()
    {
        $User['data'] = User::get();
        $User['foreign'] = array();
        return $User;
    }

    public function findUser(Request $request) {
        if(isset($request['email'])) {
            return User::where('email', '=', $request['email'])->get();
        } else {    
            return "debes enviar un email a buscar";
        }
    }


    public function getId(Request $request)
    {
        if(isset($request['facebook_id']) && isset($request['email'])) {

            $user = User::where('email', '=', $request['email'])->get();

            if($user[0]['facebook_id']==null) {
                User::find($user[0]['id'])->update(['facebook_id' => $request['facebook_id']]);
            }

            $user = User::where('facebook_id', '=', $request['facebook_id'])->get();
            return $user[0]['id'];
                        
        } else if(isset($request['google_id']) && isset($request['email'])) {
            $user = User::where('email', '=', $request['email'])->get();

            if($user[0]['google_id']==null) {
                User::find($user[0]['id'])->update(['google_id' => $request['google_id']]);
            }

            $user = User::where('google_id', '=', $request['google_id'])->get();
            return $user[0]['id'];
        } else {
            return "Debes enviar un id de red social";
        }
    }


 
    public function show($id)
    {
        return User::find($id);
        
    }
    
    public function update(Request $request, $id) {
        User::find($id)->update($request->all());
        return User::find($id);
    }

    public function destroy($id)
    {
        $obj = User::find($id);
        User::find($id)->delete();
        return $obj;
    }
 
    public function store(Request $request)  {
        return User::create($request->all());
    }
 
    
}
