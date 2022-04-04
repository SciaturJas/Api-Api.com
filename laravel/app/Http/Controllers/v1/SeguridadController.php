<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SeguridadController extends Controller
{
    function login(Request $request){

        $response = new \stdClass();
        $response_code = 0;

        $email = $request->email;
        $password = $request->password;

        $user = User::where("email","=",$request->email)
                    ->where("password","=", $password)
                    ->first();

        if($user){

            $token=$user->createToken('Laravel Password Grant Client')->accessToken;
            $response->success=true;
            $response_code=200;

            $response->data=new \stdClass();
            $response->data->token = $token;
        }else{
            $response->success=false;
            $response_code=404;
            $response->errors=[];
            $response->errors[]="Usuario y/o contraseña incorrectos";
            
        }
        return response()->json($response, $response_code);
    }
}
