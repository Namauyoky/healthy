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

    $makeForm= Request::only('pais_id','estado_id','ciudad_id');

        $paises= Pais::orderBy('Nombre_Pais','ASC')
        ->lists('Nombre_Pais','Id_Pais')
            ->toArray();


        $paisEstados=$ciudades= array();


        if($makeForm['pais_id'] !=null){

            $paisEstados= Estado::where('Id_Paises_Pais',$makeForm['pais_id'])
                ->orderBy('Nombre_Estado','ASC')
                ->lists('Nombre_Estado','Id_Estado')
                ->toArray();


            if($makeForm['estado_id']!=null){

                $ciudades = Ciudad::where('Id_Estados_Estado',$makeForm['estado_id'])
                    ->orderBy('Nombre_Ciudad','ASC')
                    ->lists('Nombre_Ciudad','Id_Ciudad')
                    ->toArray();
            }
        }

       /* $impuestosretener=ImpuestoRetener::orderBy('impuestos_nombre')
            ->lists('impuestos_nombre','idimpuesto_retener')
            ->toArray();*/

        $impuestosretener= DB::table('impuestos_retener')
            ->select('idimpuesto_retener',DB::raw('CONCAT(impuestos_nombre,"-",impuesto_porcentaje,"%") AS impuesto'))
        ->lists('impuesto','idimpuesto_retener');

        $view ->with(compact('makeForm','paises','paisEstados','ciudades','impuestosretener'));




    }

}