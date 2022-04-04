<?php

namespace App\Models\v1;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Categoria;

class Producto extends Model
{
  use HasUUID;
  protected $table = 'productos';
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';
  protected $uuidFieldName = 'id';//Requiere para insertar nuevo producto

  function categoria(){
    return $this->belongsTo(Categoria::class, "categoria_id");
  }
}
