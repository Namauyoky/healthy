<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $table='clientes';
    //Campos para asignación masiva, es decir que pueden ser enviados por medio del formulario
    protected $fillable=[
        'Patrocinador',
        'Nip',
        'Nombre',
        'Apellidos',
        'Fecha_Nacimiento',
        'Domicilio',
        'Colonia',
        'CodigoPostal',
        'Id_Ciudades_Ciudad',
        'Id_Estados_Estado',
        'Id_Paises_Pais',
        'Telefono',
        'Tel_Celular',
        'Correo_Electronico',
        'Identificacion',
        'Genero',
        'EdoCivil',
        'Ocupacion',
        'RFC',
        'Id_RedOrigen',
        
    ];
    protected $primaryKey='Id_Afiliado';
    public $timestamps = false;

    
    public function scopeName($query,$nombre){

        //dd($nombre);
        $query-> where('nombre_completo',"LIKE","%$nombre%");

    }
}
