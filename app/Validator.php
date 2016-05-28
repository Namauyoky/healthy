<?php
/**
 * Created by PhpStorm.
 * User: SistemasDesarrollo
 * Date: 25/05/2016
 * Time: 02:31 PM
 */

namespace healthy;

use healthy\Models\Clientes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator as LaravelValidator;

class Validator extends LaravelValidator
{

    public function validatePatrocinador($attribute,$value,$parameters){


        $cliente=DB::table('clientes')
            ->where('Id_Afiliado',$value)
            ->where('Tipo_Cliente','>',2)
            ->where('Estado_Cliente','=',1)
            ->get();

        if (count($cliente)>0){
            return true;
        }
        else
        {
            return false;
        }




    }

}