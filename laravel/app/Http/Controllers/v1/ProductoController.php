<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\v1\Producto;
use GrahamCampbell\ResultType\Success;

class ProductoController extends Controller
{
  //Lista de productos
  function obtenerLista(){
    $productos = Producto::with('categoria')->get();

    $response = new \stdClass();
    $response->success=true;
    $response->data=$productos;

    return response()->json($response, 200);
  }

  function obtenerItem($id){
    $producto = Producto::where("id","=",$id)->with('categoria')->get()->find($id);;

    $response = new \stdClass();
    $response->success=true;
    $response->data=$producto;

    return response()->json($response, 200);
  }
  //Actualizar producto
  function update(Request $request){
    $producto = Producto::find($request->id);

    if($producto){
        $producto->codigo= $request->codigo;
        $producto->nombre= $request->nombre;
        $producto->categoria_id= $request->categoria_id;
        $producto->save();
    }

    $response = new \stdClass();
    $response->success = true;
    $response->data = $producto;

    return response()->json($response, 200);
  }

  function patch(Request $request){
    $producto = Producto::find($request->id);

    if($producto){

        if(isset($request->codigo))
        $producto->codigo= $request->codigo;

        if(isset($request->nombre))
        $producto->nombre= $request->nombre;
        
        $producto->save();
    }

    $response = new \stdClass();
    $response->success = true;
    $response->data = $producto;

    return response()->json($response, 200);
  }
  //Insertar nuevo producto
  function store(Request $request){

    $producto = new Producto();
    $producto->codigo = $request->codigo;
    $producto->nombre = $request->nombre;
    $producto->categoria_id = $request->categoria_id;
    $producto->save();

    $response = new \stdClass();
    $response->success = true;
    $response->data=$producto;

    return response()->json($producto);
  }
  //Eliminar producto
  function delete($id){
      
    $response = new \stdClass();
    $response->success=true;
    $response_code=200;

    $producto = Producto::find($id);
    if($producto){
        $producto->delete();
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
