<?php

namespace healthy;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    //
    protected $table='productos';
    protected $primaryKey='Id_Producto';

    public $timestamps = false;

}
