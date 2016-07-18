<?php
/**
 * Created by PhpStorm.
 * User: SistemasDesarrollo
 * Date: 14/07/2016
 * Time: 02:32 PM
 */

namespace healthy\Repositories;


class PeriodsRepository
{

    public function periods(){

        return $periods= \DB::table('periodos')
            ->OrderBy('Id','DESC')
            ->get();
    }

    public function periodshistoric($id,$edocuenta,$comisiones){

        return $edocuentahistoric= \DB::table($edocuenta)
            ->where('Id_Clientes_Afiliado','id')
            ->first();
    }

}