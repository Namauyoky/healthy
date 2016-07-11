<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $table='estados';
    protected $fillable =['Nombre_Estado'];
    protected $primaryKey='Id_Estado';


    public $timestamps = false;



    public static function states($id){
        
        return Estado::where('Id_Paises_Pais','=',$id)
            ->get();
    }

}
