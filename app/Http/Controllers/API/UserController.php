<?php
 
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user['token'] = "Bearer " . $user->createToken('MyApp')->accessToken;
            return response()->json($user, $this->successStatus);
        }
        else{
            $user = User::where("email","=",request('email'))->get();
            if(count($user)==0) {
                return response()->json(['error'=>"Correo eléctronico no está registrado"], $this->successStatus);
            } else {
                return response()->json(['error'=>"Contraseña incorrecta"], $this->successStatus);
            } 
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = User::where("email","=",request('email'))->get();
        if(count($user)>=1) {
            return response()->json(['error'=>"Correo eléctronico está registrado"], $this->successStatus);
        } 
        if(request('c_password')!=request('password')) {
            return response()->json(['error'=>"Las contrasenas no coinciden"], $this->successStatus);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user['token'] = "Bearer " . $user->createToken('MyApp')->accessToken;
        return response()->json($user, $this->successStatus);
    }

    public function changePassword(Request $request) {
        $request['password'] = bcrypt($request['password']);
        User::find($request->input('id'))->update($request->all());
        return User::find($request->input('id'));
    }

    public function resetPassword(Request $request) {
        if(isset($request['email'])) {
            if($request['email']!="") {
                $user = User::where('email', '=', $request['email'])->get();
                if(count($user)!=0) {
                    $token = str_random(50);
                    $user_id = md5($user[0]["id"]);
                    User::find($user[0]["id"])->update(array('remember_token' => $token));
                    Mail::send('emails.ResetPassword', ['token' => $token, 'user_name' => $user[0]['name'], 'user_id'=> $user_id, 'server' => $_SERVER['HTTP_HOST']] , function ($message) use($request)
                    {
                        $message->from('anthonyjmedinaf@gmail.com', 'Clienbot');
                        $message->to($request['email']);
                        $message->subject("Recuperación de contraseña de acceso a Clienbot");
                    });
                    return response()->json(['message'=>"Se ha enviado un correo electronico a la direccion " . $request['email']], $this->successStatus);
                } else {
                    return response()->json(['message'=>"Esta direccion de correo electronico no se encuentra registrada"], $this->successStatus);
                }
            } else {
                return response()->json(['message'=>"Por favor, envia una direccion de correo electronico valida"], $this->successStatus);

            }
        } else {
                return response()->json(['message'=>"Por favor, envia una direccion de correo electronico valida"], $this->successStatus);
        }   
    }

    public function verifyTokenForChangePassword(Request $request) {
        if(isset($request['token'])) {
            if(isset($request['id'])) {
                        $user = User::where('remember_token', '=', $request['token'])->get();
                        if(count($user)!=0) {
                            if(md5($user[0]['id']) == $request['id']) {
                                return response()->json(['message'=>"La contrasena puede cambiarse"], 201);
                            } else {

                                return response()->json(['message'=>"No estas autorizado para realizar esta accion"], $this->successStatus);
                            }
                        } else {
                            return response()->json(['message'=>"El token enviado no existe o se ha expirado"], $this->successStatus);
                        }
                    

            } else {
                return response()->json(['message'=>"Debes enviar un id valido"], $this->successStatus);
            }
        } else {
            return response()->json(['message'=>"Debes enviar un token valido"], $this->successStatus);

        }

    }
    public function changePasswordFromToken(Request $request) {

        if(isset($request['token'])) {
            if(isset($request['id'])) {

                if(isset($request['password']) && isset($request['c_password'])) {
                    if($request['password']==$request['c_password']) {
                        $user = User::where('remember_token', '=', $request['token'])->get();
                        if(count($user)!=0) {
                            if(md5($user[0]['id']) == $request['id']) {
                                 $request['password'] = bcrypt($request['password']);
                                 $request['remember_token'] = null;
                                 User::find($user[0]['id'])->update($request->all());
                                return response()->json(['message'=>"Tu contraseña ha sido cambiada correctamente"], 201);
                            } else {

                                return response()->json(['message'=>"No estas autorizado para realizar esta accion"], $this->successStatus);
                            }


                        } else {
                            return response()->json(['message'=>"El token enviado no existe o se ha expirado"], $this->successStatus);
                        }

                        


                    } else {
                        return response()->json(['message'=>"Las contraseñas no coinciden"], $this->successStatus);
                    }
                } else {
                    return response()->json(['message'=>"Debes rellenar ambos campos"], $this->successStatus);
                }

            } else {
                return response()->json(['message'=>"Debes enviar un id valido"], $this->successStatus);
            }
        } else {
            return response()->json(['message'=>"Debes enviar un token valido"], $this->successStatus);

        }
    }



    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}