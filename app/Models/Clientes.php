<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $table='clientes';
    //Campos para asignación masiva, es decir que pueden ser enviados por medio del formulario
    protected $fillable=[
        'Id_Cliente_Patrocinador',
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
        'Estado_Cliente',
        
    ];
    protected $primaryKey='Id_Afiliado';
    public $timestamps = false;

    
    public function scopeName($query,$nombre){

        //dd('scope'. $nombre);
        if(trim($nombre) != ""){

            $query-> where('nombre_completo',"LIKE","%$nombre%");
        }

    }

    public function ciudad(){

        return $this->belongsTo('healthy\Models\Ciudad','Id_Ciudades_Ciudad');
    }
    
    public function estado(){
        
        return $this->belongsTo('healthy\Models\Estado','Id_Estados_Estado');
    }
    
    public function pais(){
        
        return $this->belongsTo('healthy\Models\Pais','Id_Paises_Pais');
    }

    public function patrocinador(){

        return $this->belongsTo('healthy\Models\Clientes','Id_Cliente_Patrocinador')
            ->select(array('Id_Afiliado','nombre_completo'))
            ;
    }

    public function patrocinados(){

        return $this->hasMany('healthy\Models\Clientes','Id_Cliente_Patrocinador','Id_Afiliado')
            ->select(array('Id_Afiliado','nombre_completo'))
            ;
    }

    public function red(){

        return $this->belongsTo('healthy\Models\Red','Id_RedOrigen');
    }

    public function user(){

        return $this->belongsTo('healthy\User','Id_Usuarios_UsuarioAlta');
    }

    public function status(){
        return $this->belongsTo('healthy\Models\Estatus','Estado_Cliente');
    }

    public function cuentabanco(){
        return $this->hasOne('healthy\Models\CountBank','Id_Afiliado');
    }

    public function clienteimpuesto(){
        return $this->belongsTo('healthy\Models\ImpuestoRetener','Tipo_ImpuestoRetener');

    }
}
