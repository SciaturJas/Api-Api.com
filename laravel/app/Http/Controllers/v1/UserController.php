<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  function store(Request $request){
    $response = new \stdClass();
    $response_code = 0;

    $user_db = User::where("email","=",$request->email)->first();

    if($user_db){
      $response_code=404;
      $response->success=false;
      $response->errors=[];
      $response->errors="El usuario ya esta registrado";

    }else{
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->save();
  
      $response_code = 200;
  
      $response->success=true;
      $response->data = $user;
    }

    return response()->json($response, $response_code);
  }
}
