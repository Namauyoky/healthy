<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $table='clientes';
    //Campos para asignación masiva, es decir que pueden ser enviados por medio del formulario
    protected $fillable=[
        'Nip',
        'Nombre',
        'Apellidos',
        'Domicilio',
        'Colonia',
        'CodigoPostal',
        'Id_Ciudades_Ciudad',
        'Id_Estados_Estado',
        'Id_Paises_Pais',
        'Telefono',
        'Correo_Electronico',
        'Tel_Celular',
        'Fecha_Nacimiento',
        'Identificacion',
      

    ];
    protected $primaryKey='Id_Afiliado';
    public $timestamps = false;

    
    public function scopeName($query,$nombre){

        //dd($nombre);
        $query-> where('nombre_completo',"LIKE","%$nombre%");

    }
}
