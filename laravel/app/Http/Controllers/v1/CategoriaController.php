<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\v1\Categoria;

class CategoriaController extends Controller
{
  //Lista de categorias
  function obtenerLista(){
    $categorias = Categoria::where("nombre","like","%")
                  ->orderBy("nombre","asc")
                  ->get();

    $response = new \stdClass();
    $response->success=true;
    $response->data=$categorias;

    return response()->json($response, 200);
  }

  function obtenerItem($id){
    $categoria = Categoria::find($id);

    $response = new \stdClass();
    $response->success=true;
    $response->data=$categoria;

    return response()->json($response, 200);
  }
  //Actualizar categoria
  function update(Request $request){
    $categoria = Categoria::find($request->id);

    if($categoria){
        $categoria->codigo= $request->codigo;
        $categoria->nombre= $request->nombre;
        $categoria->save();
    }

    $response = new \stdClass();
    $response->success = true;
    $response->data = $categoria;

    return response()->json($response, 200);
  }

  function patch(Request $request){
    $categoria = Categoria::find($request->id);

    if($categoria){

        if(isset($request->codigo))
        $categoria->codigo= $request->codigo;

        if(isset($request->nombre))
        $categoria->nombre= $request->nombre;
        
        $categoria->save();
    }

    $response = new \stdClass();
    $response->success = true;
    $response->data = $categoria;

    return response()->json($response, 200);
  }
  //Insertar nueva categoria
  function store(Request $request){

    $categoria = new Categoria();
    $categoria->codigo = $request->codigo;
    $categoria->nombre = $request->nombre;
    $categoria->save();

    $response = new \stdClass();
    $response->success = true;
    $response->data=$categoria;

    return response()->json($categoria);
  }
  //Eliminar categoria
  function delete($id){
      
    $response = new \stdClass();
    $response->success=true;
    $response_code=200;

    $categoria = Categoria::find($id);
    if($categoria){
        $categoria->delete();
        $response->success=true;
        $response_code=200;
    }
    else{
        $response->error=["El elemento ya ha sido eliminado"];
        $response->success=false;
        $response_code=500;
    }
    
    return response()->json($response, $response_code);
  }
}
