<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class CountBank extends Model
{
    //
    protected $table='clientescuentas';
    public $timestamps = false;


    protected $fillable=[
        'Id_Afiliado',
        'banco',
        'cuenta',
        'tipopago'

    ];


    public function cliente(){
        //aquí especificamos que una cuenta, pertenece a un cliente.
        return $this->belongsTo('healthy\Models\Clientes','Id_Afiliado');

    }
}
