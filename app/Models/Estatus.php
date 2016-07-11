<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    //
    //
    protected $table='tipostatusclientes';
    protected $primaryKey='id_tipostatus';

    public $timestamps = false;


    public function clientesconstatus(){


        return $this->belongsToMany('healthy\Models\Clientes','');


    }


}
