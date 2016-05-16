<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //
    protected $table='ciudades';
    protected $primaryKey='Id_Ciudad';
    protected $fillable=['Nombre_Ciudad','Id_Estados_Estado'];


    public $timestamps = false;
}
