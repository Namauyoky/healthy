<?php

namespace healthy\Repositories;
use healthy\Models\Clientes;


/**
 * Created by PhpStorm.
 * User: SistemasDesarrollo
 * Date: 05/07/2016
 * Time: 09:16 AM
 */
class ClientRepository
{


    public function puntosClient($edocuenta,$id){

       return  $puntoscliente= \DB::table($edocuenta)
            ->select(
                $edocuenta.'.'.'Puntoscalificacion',
                $edocuenta.'.'.'Puntosnegocio',
                $edocuenta.'.'.'Puntoshealthy')
            ->where($edocuenta.'.'.'Id_Clientes_Afiliado','=',$id)
            ->first();
    }
    
    
    public function findClient($id){
        
        return $cliente= Clientes::find($id);
    }

    public function redMultinivel($edocuenta,$id){


        //Se Obtiene la red desordenada del Afiliado= $id

        $clientesred= \DB::table('clientes')
            ->join($edocuenta, 'clientes.Id_Afiliado', '=', $edocuenta.'.'.'Id_Clientes_Afiliado')
            ->select(
                $edocuenta.'.'.'Id_Clientes_Afiliado',
                'clientes.Id_Cliente_Patrocinador',
                'clientes.nombre_completo',
                $edocuenta.'.'.'Id_Clientes_Padre',
                $edocuenta.'.'.'Id_Niveles_TipoNivel',
                $edocuenta.'.'.'Puntoscalificacion',
                $edocuenta.'.'.'Puntosnegocio',
                $edocuenta.'.'.'Puntoshealthy'

            )
            ->where($edocuenta.'.'.'Id_Clientes_Padre','=',$id)
            ->orderBy($edocuenta.'.'.'Id_Niveles_TipoNivel', 'ASC')
            ->get();

        
        //dd($clientesred);

        //El array se convierte en una colección para poder hacer los filtros de nivel.
        $clientesred= collect($clientesred);
        $arraynivelesred= array();


//        $puntosgrupales= $clientesred->sum('Puntoscalificacion');


        //dd($puntosgrupales);


        // dd($clientesred);

        //Hacemos la consulta de los Afiliados por niveles y los almacenamos en  objetos de esas consultas

        $clientesuno = $clientesred->filter(function($category) {
            return $category->Id_Niveles_TipoNivel == 1 ? true : false;

        });

        array_push($arraynivelesred,$clientesuno);

        //Consulta de todos los Afiliados del Nivel 2
        $clientesdos=$clientesred->filter(function($category) {
            return $category->Id_Niveles_TipoNivel == 2 ? true : false;
        });

        array_push($arraynivelesred,$clientesdos);

        //Consulta de todos los Afiliados del Nivel 3
        $clientestres = $clientesred->filter(function ($category) {
            return $category->Id_Niveles_TipoNivel == 3 ? true : false;
        });

        array_push($arraynivelesred,$clientestres);

        //Consulta de todos los Afiliados del Nivel 4
        $clientescuatro = $clientesred->filter(function ($category) {
            return $category->Id_Niveles_TipoNivel == 4 ? true : false;
        });

        array_push($arraynivelesred,$clientescuatro);

        //Consulta de todos los Afiliados del Nivel 5
        $clientescinco = $clientesred->filter(function ($category) {
            return $category->Id_Niveles_TipoNivel == 5 ? true : false;
        });

        array_push($arraynivelesred,$clientescinco);

        //Consulta de todos los Afiliados del Nivel 6
        $clientesseis = $clientesred->filter(function ($category) {
            return $category->Id_Niveles_TipoNivel == 6 ? true : false;
        });

        array_push($arraynivelesred,$clientesseis);

        //Consulta de todos los Afiliados del Nivel 7
        $clientessiete = $clientesred->filter(function ($category) {
            return $category->Id_Niveles_TipoNivel == 7 ? true : false;
        });

        array_push($arraynivelesred,$clientessiete);

        $arrayred= array();
        
        
        foreach ($clientesuno as $niveluno)
        {

            //Obtenemos el Primer Afiliado en Nivel 1 y agregamos sus datos al array
            $tmpNivel01=$niveluno->Id_Clientes_Afiliado;
            array_push($arrayred, array(
                "Afiliado"              => $niveluno->Id_Clientes_Afiliado,
                "Patrocinador"          => $niveluno->Id_Cliente_Patrocinador,
                "Nombre"                =>'.1-'.' '. $niveluno->nombre_completo,
                "Puntoscalificacion"    =>$niveluno->Puntoscalificacion,
                "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                "Puntoslealtad"         =>$niveluno->Puntoshealthy

            ));

            //Recorremos el resultado de la Consulta del nivel 2
            foreach ($clientesdos as $niveldos)
            {

                //comparamos, si el patrocinador de los Afiliados que están en nivel 2 es igual al patrocinador del Afiliado tomado en Nivel 1
                if ($tmpNivel01 == $niveldos->Id_Cliente_Patrocinador)
                {

                    $tmpNivel02 = $niveldos->Id_Clientes_Afiliado;
                    //Si El Primer Afiliado del Nivel 1 es patrocinador de los afiliados consecuentes en nivel 2, los insertamos al arreglo.
                    array_push($arrayred, array(
                        "Afiliado"              => $niveldos->Id_Clientes_Afiliado,
                        "Patrocinador"          => $niveldos->Id_Cliente_Patrocinador,
                        "Nombre"                => '.      .      2-' . ' ' . $niveldos->nombre_completo,
                        "Puntoscalificacion"    =>$niveldos->Puntoscalificacion,
                        "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                        "Puntoslealtad"         =>$niveluno->Puntoshealthy
                    ));

                    foreach ($clientestres as $niveltres)
                    {
                        //comparamos, si el patrocinador de los Afiliados que están en nivel 3 es igual al patrocinador del Afiliado tomado en Nivel 2
                        if ($tmpNivel02 == $niveltres->Id_Cliente_Patrocinador)
                        {

                            $tmpNivel03 = $niveltres->Id_Clientes_Afiliado;
                            //Si El Primer Afiliado del Nivel 2 es patrocinador de los afiliados consecuentes en nivel 3, los insertamos al arreglo.
                            array_push($arrayred, array(
                                "Afiliado"              => $niveltres->Id_Clientes_Afiliado,
                                "Patrocinador"          => $niveltres->Id_Cliente_Patrocinador,
                                "Nombre"                => '.      .      .      3-' . ' ' . $niveltres->nombre_completo,
                                "Puntoscalificacion"    =>$niveltres->Puntoscalificacion,
                                "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                                "Puntoslealtad"         =>$niveluno->Puntoshealthy
                            ));

                            foreach ($clientescuatro as $nivelcuatro)
                            {
                                if($tmpNivel03== $nivelcuatro->Id_Cliente_Patrocinador)
                                {

                                    $tmpNivel04 = $nivelcuatro->Id_Clientes_Afiliado;
                                    //Si El Primer Afiliado del Nivel 3 es patrocinador de los afiliados consecuentes en nivel 4, los insertamos al arreglo.
                                    array_push($arrayred, array(
                                        "Afiliado"              => $nivelcuatro->Id_Clientes_Afiliado,
                                        "Patrocinador"          => $nivelcuatro->Id_Cliente_Patrocinador,
                                        "Nombre"                => '.      .      .      .      4-' . ' ' . $nivelcuatro->nombre_completo,
                                        "Puntoscalificacion"    =>$nivelcuatro->Puntoscalificacion,
                                        "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                                        "Puntoslealtad"         =>$niveluno->Puntoshealthy
                                    ));

                                    foreach ($clientescinco as $nivelcinco)
                                    {

                                        if ($tmpNivel04 == $nivelcinco->Id_Cliente_Patrocinador)
                                        {
                                            $tmpNivel05 = $nivelcinco->Id_Clientes_Afiliado;
                                            //Si El Primer Afiliado del Nivel 4 es patrocinador de los afiliados consecuentes en nivel 5, los insertamos al arreglo.
                                            array_push($arrayred, array(
                                                "Afiliado"              => $nivelcinco->Id_Clientes_Afiliado,
                                                "Patrocinador"          => $nivelcinco->Id_Cliente_Patrocinador,
                                                "Nombre"                => '.      .      .      .      .      5-' . ' ' . $nivelcinco->nombre_completo,
                                                "Puntoscalificacion"    =>$nivelcinco->Puntoscalificacion,
                                                "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                                                "Puntoslealtad"         =>$niveluno->Puntoshealthy
                                            ));

                                            foreach ($clientesseis as $nivelseis)
                                            {
                                                if ($tmpNivel05 == $nivelseis->Id_Cliente_Patrocinador)
                                                {
                                                    $tmpNivel06 = $nivelseis->Id_Clientes_Afiliado;
                                                    //Si El Primer Afiliado del Nivel 5 es patrocinador de los afiliados consecuentes en nivel 6, los insertamos al arreglo.
                                                    array_push($arrayred, array(
                                                        "Afiliado"              => $nivelseis->Id_Clientes_Afiliado,
                                                        "Patrocinador"          => $nivelseis->Id_Cliente_Patrocinador,
                                                        "Nombre"                => '.      .      .      .      .      .      6-' . ' ' . $nivelseis->nombre_completo,
                                                        "Puntoscalificacion"    => $nivelseis->Puntoscalificacion,
                                                        "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                                                        "Puntoslealtad"         =>$niveluno->Puntoshealthy

                                                    ));

                                                    foreach ($clientessiete as $nivelsiete)
                                                    {
                                                        if ($tmpNivel06 == $nivelsiete->Id_Cliente_Patrocinador)
                                                        {
                                                            //Si El Primer Afiliado del Nivel 6 es patrocinador de los afiliados consecuentes en nivel 7, los insertamos al arreglo.
                                                            array_push($arrayred, array(
                                                                "Afiliado"              => $nivelsiete->Id_Clientes_Afiliado,
                                                                "Patrocinador"          => $nivelsiete->Id_Cliente_Patrocinador,
                                                                "Nombre"                => '.      .      .      .      .      .      .      7-' . ' ' . $nivelsiete->nombre_completo,
                                                                "Puntoscalificacion"    =>$nivelsiete->Puntoscalificacion,
                                                                "Puntosnegocio"         =>$niveluno->Puntosnegocio,
                                                                "Puntoslealtad"         =>$niveluno->Puntoshealthy
                                                            ));

                                                        }//---/if nivel siete
                                                    }//---/foreach nivel siete
                                                }//---/if nivel seis
                                            }//---/foreach nivel sies
                                        }//---/if nivel cinco
                                    }//---/foreach nivel cinco
                                }//---/if nivel cuatro
                            }//---/foreach nivel cuatro
                        }//---/if nivel tres
                    }//---/foreach nivel tres
                }//---/if nivel dos
            }//---/foreach nivel dos
        }//---/foreach nivel uno

        $arrayred= collect($arrayred);
        $arraynivelesred= collect($arraynivelesred);

        
        return [$arrayred,$arraynivelesred];
    }

}