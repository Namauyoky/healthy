<?php
/**
 * Created by PhpStorm.
 * User: SistemasDesarrollo
 * Date: 27/05/2016
 * Time: 09:21 AM
 */

namespace healthy\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;


class ClientComposer
{


    public function compose(View $view)
    {


        /* $impuestosretener=ImpuestoRetener::orderBy('impuestos_nombre')
            ->lists('impuestos_nombre','idimpuesto_retener')
            ->toArray();*/

        $impuestosretener= DB::table('impuestos_retener')
            ->select('idimpuesto_retener',DB::raw('CONCAT(impuestos_nombre,"-",impuesto_porcentaje,"%") AS impuesto'))
            ->lists('impuesto','idimpuesto_retener');


        $redorigen=DB::table('redorigen')
            ->select('Id_redorigen','descripcion')
            ->lists('Id_redorigen','descripcion');


        $view ->with(array('impuestosretener' => $impuestosretener,'red' => $redorigen ));

        //Enviar varias variables a las vistas
//        $view->with(array('varible1' => $varible1, 'varible2' => $variable2));






    }

}