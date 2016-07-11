<?php
/**
 * Created by PhpStorm.
 * User: SistemasDesarrollo
 * Date: 16/05/2016
 * Time: 01:10 PM
 */

namespace healthy\Http\ViewComposers;

use healthy\Models\ImpuestoRetener;
use healthy\Models\Ciudad;
use healthy\Models\Estado;
use healthy\Models\Pais;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class MakeModelForm
{

    public function compose(View $view){

    $ubicationForm= Request::only('pais_id','estado_id','ciudad_id');

        $paises= Pais::orderBy('Nombre_Pais','ASC')
        ->lists('Nombre_Pais','Id_Pais')
            ->toArray();

        $paisEstados=$ciudades= array();

        if($ubicationForm['pais_id'] !=null){

            $paisEstados= Estado::where('Id_Paises_Pais',$ubicationForm['pais_id'])
                ->orderBy('Nombre_Estado','ASC')
                ->lists('Nombre_Estado','Id_Estado')
                ->toArray();

            if($ubicationForm['estado_id']!=null){

                $ciudades = Ciudad::where('Id_Estados_Estado',$ubicationForm['estado_id'])
                    ->orderBy('Nombre_Ciudad','ASC')
                    ->lists('Nombre_Ciudad','Id_Ciudad')
                    ->toArray();
            }
        }

        $view ->with(compact('ubicationForm','paises','paisEstados','ciudades'));

    }

}