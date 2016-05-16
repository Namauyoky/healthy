<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $table='clientes';

    protected $primaryKey='Id_Afiliado';
    public $timestamps = false;
}
