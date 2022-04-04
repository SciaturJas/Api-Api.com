<?php

namespace App\Models\v1;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

use App\Models\v1\Producto;

class Categoria extends Model
{
  use HasUUID;
  protected $table = 'categorias';
  protected $primaryKey = 'id';
  public $incrementing = false;
  protected $keyType = 'string';
  protected $uuidFieldName = 'id';//Requiere para insertar nuevo producto

  protected $hidden = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function productos(){
    return $this->hasMany(Producto::class, "categoria_id");
  }
}
