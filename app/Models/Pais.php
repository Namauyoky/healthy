<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //
    protected $table='paises';
    protected $primaryKey='Id_Pais';

    public $timestamps = false;
}
