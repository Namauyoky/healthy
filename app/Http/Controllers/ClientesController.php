<?php

namespace healthy\Http\Controllers;


use Faker\Provider\DateTime;
use healthy\Http\Requests\CreateClientRequest;
use healthy\Models\Ciudad;
use healthy\Models\Clientes;
use healthy\Models\CountBank;
use healthy\Models\Estado;
use healthy\Models\Periodo;
use healthy\Repositories\ClientRepository;
use healthy\User;
use Illuminate\Auth\Guard;

use healthy\Http\Requests;
use healthy\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;// Aquí indicamos que usaremos Carbon
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ClientesController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//
//        $clients= Clientes::select('Id_Afiliado','Nombre','Apellidos','Id_Cliente_Patrocinador','Telefono','Correo_Electronico','Nip','FechaAlta','Fecha_ultcompra','Id_Ciudades_Ciudad','Estado_Cliente','Id_RedOrigen')
//            ->with('patrocinador','status','red')
//        ->orderBy('Id_Afiliado','DESC')
//        ->take(100);

        $clients= Clientes::name($request->get('name'))
        ->select('Id_Afiliado','Nombre','Apellidos','Id_Cliente_Patrocinador','Telefono','Correo_Electronico','Nip','FechaAlta','Fecha_ultcompra','Id_Ciudades_Ciudad','Estado_Cliente','Id_RedOrigen')
        ->with('patrocinador','status','red')
        ->orderBy('Id_Afiliado','DESC')
        ->take(100)
        ->paginate();


        //dd($clients);

        return view('clientes.consulta',compact('clients'));
    }
    
    public function nuevos(){

        $date=Carbon::now();
        $dateformated= $date->toDateString();

        $lastclients=Clientes::with('patrocinador')
            -> where('FechaAlta',"LIKE","%$dateformated%")
            -> orderBy('Id_Afiliado','DESC')
            ->get(array('Id_Afiliado','nombre_completo','Id_Cliente_Patrocinador','Nip'));

        return view('clientes.listanuevos',compact('lastclients'));
    }

    /**
     * Show the form for creating a new resource Cliente...
     */
    public function create()
    {
        //
//        $states=['estados' => Estado::lists('Nombre_Estado','Id_Estado')];
       return view('clientes.create');
    }

    /**
     * Store a newly created resource Cliente in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request,Guard $auth)
    {
        
//        //Opcion sin usar Requests para validar
//        $this->validate($request,[
//
//            'name'              =>'required|max:40|string',
//            'apellidos'         =>'required|max:50|string',
//            'nip'               =>'required|alpha_num',
//            'nacimiento'        =>'required|date',
//            'identificacion'    =>'required|max:255|alpha_num',
//            'pais_id'           =>'required',
//            'estado_id'         =>'required',
//            'ciudad_id'         =>'required',
//
//
//        ]);

        \DB::beginTransaction();

        try {

            //------Fecha Actual
            $date=Carbon::now();
            $dateformated= $date->toDateString();
            //----------------------------------------
            $cliente=new Clientes($request->all());
            $padre=$cliente->Id_Cliente_Patrocinador=$request->patrocinador;
            srand ((double) microtime( )*1000000);
            $nip = rand();
            $cliente->Nip=$nip;
            $cliente->Nombre=$request->nombre;
            $cliente->Apellidos= $request->apellidos;
            $cliente->nombre_completo= $request->nombre. ' ' .$request->apellidos;
            $cliente->Fecha_Nacimiento= $request->nacimiento;
            $cliente->Domicilio= $request->domicilio;
            $cliente->Colonia= $request->colonia;
            $cliente->CodigoPostal=$request->codigop;
            $cliente->Id_Ciudades_Ciudad= $request->ciudad_id;
            $cliente->Id_Estados_Estado= $request->estado_id;
            $cliente->Id_Paises_Pais=$request->pais_id;
            $cliente->Telefono= $request->telefono;
            $cliente->Tel_Celular= $request->celular;
            $cliente->Correo_Electronico=$request->mail;
            $cliente->Identificacion= $request->identificacion;
            $cliente->Genero= $request->get('genero');
            $cliente->EdoCivil= $request->get('edocivil');
            $cliente->Ocupacion= $request->get('ocupacion') ;
            $cliente->NoSeguro= $request->rfc;
            $cliente->RFC= $request->rfc;
            $cliente->Id_Cliente_Patrocinador_ant= $request->patrocinador;
            $cliente->FechaAlta=$dateformated;
            $cliente->Fecha_ultcompra=$dateformated;
            $cliente->Puntos=0;
            $cliente->Estado_Cliente=2;
            $cliente->Tipo_ImpuestoRetener=$request->impuestos;
            $cliente->Id_Usuarios_UsuarioAlta=$auth->id();
            $cliente->Id_RedOrigen=$request->red;
            $cliente->Tipo_Cliente=1;
            $cliente->save();

            //Dar Alta de Cuenta de Banco tomando la relación
            CountBank::create(array(
               
                'Id_Afiliado' => $cliente->Id_Afiliado,
                'banco'       => $request->banco,
                'cuenta'      => $request->cuenta,
                'tipopago'    => $request->tipopago
            ));
            
            //Ejecuta el Procedimiento Almacenado para crear Red Multinivel del nuevo afiliado.
            \DB::select('CALL Multinivel(?,?)',array($padre,$cliente->Id_Afiliado));

            //Mensaje Success de Alta Correcta.
            //si no queremos usar laracasts/flash, descomentar /comentar
            //flash('Cliente Creado Correctamente')->important();
            //flash()->success('Cliente Creado Correctamente')->important();
            \Alert::message('Cliente Creado Correctamente','info');

            //$this->pdfClientRegister($cliente);
            
//            $this->send(
//                $request->mail,
//                $request->nombre. ' ' .$request->apellidos,
//                $cliente->Id_Afiliado,
//                $cliente->Nip
//            );

            //Envío de Correo de Confirmación a Cliente.
//            \Mail::send('emails.registrocliente',$cliente->toArray(),function($message)use($cliente){
//
//                //remitente
//                $message->from('registro@healthypeopleco.com','Registro');
//                //asunto
//                $message->subject('Bienvenido');
//                //receptor
//                $message->to($cliente->Correo_Electronico, $cliente->nombre_completo);
//
//            });
            
            //Si no hubo error alguno , en los procesos anteriores , hacemos commit para ejecutar todos los procesos
            \DB::commit();
            
            
            return redirect()->route('clientes-lists');
        }
            // Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
            \DB::rollback();

            //return 'Error de Datos'.'ERROR (' . $e->getCode() . '): ' . $e->getMessage();

            return redirect()->to('alta-cliente')
                ->withErrors($e->getMessage())
                ->withInput(\Input::all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return View
     */
    public function show($id)
    {
        //
        $cliente= Clientes::with('patrocinador','red','status')
            ->find($id);

        return view('clientes.detalle',compact('cliente'));
    }
    
    public function buscar(Request $request){

        if($request->ajax()){

            $cliente=$request->input('patrocinador');
            //$cliente= $request->get('patrocinador');
//            $users = DB::table('users')->get();
//            return Response::json(array(
//                'users' => 	$users
//            ));
//
            $users= User::name($request->get('patrocinador'));

            return Response::json(array(
                'users' => $users
            ));
        }
    }

    public function consultaname(Request $request){

        //dd($request->get('nombre'));

        $clients= Clientes::name($request->get('nombre'))
            ->orderBy('Id_Afiliado','DESC')->paginate();
        return view('partials.list-clientes',compact('clients'));

        //return $clients;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        //
        //
        $cliente= Clientes::with('patrocinador','red','status','cuentabanco')
            ->find($id);
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cliente= Clientes::find($id);

        //----------------------------------------
        $cliente->Nombre=$request->Nombre;
        $cliente->Apellidos= $request->Apellidos;
        $cliente->nombre_completo= $request->Nombre. ' ' .$request->Apellidos;
        $cliente->Fecha_Nacimiento= $request->Fecha_Nacimiento;
        $cliente->Domicilio= $request->Domicilio;
        $cliente->Colonia= $request->Colonia;
        $cliente->CodigoPostal=$request->CodigoPostal;
        $cliente->Id_Ciudades_Ciudad= $request->ciudad_id;
        $cliente->Id_Estados_Estado= $request->estado_id;
        $cliente->Id_Paises_Pais=$request->pais_id;
        $cliente->Telefono= $request->Telefono;
        $cliente->Tel_Celular= $request->Tel_Celular;
        $cliente->Correo_Electronico=$request->Correo_Electronico;
        $cliente->Identificacion= $request->Identificacion;
        $cliente->Genero= $request->get('Genero');
        $cliente->EdoCivil= $request->get('EdoCivil');
        $cliente->Ocupacion= $request->get('Ocupacion') ;
        $cliente->NoSeguro= $request->RFC;
        $cliente->RFC= $request->RFC;
        $cliente->Tipo_ImpuestoRetener=$request->impuestos;
        $cliente->cuentabanco->banco= $request->Banco;
        $cliente->cuentabanco->cuenta= $request->cuenta;
        $cliente->cuentabanco->tipopago= $request->tipopago;


        $cliente->push();
        $clienteid= $cliente->Id_Afiliado;

        //flash('Cliente'.' '. $cliente->Id_Afiliado.' '. 'Se Actualizó Correctamente')->important();
        //\Alert('Cliente'.' '. $cliente->Id_Afiliado.' '. 'Se Actualizó Correctamente');

        \Alert::info('Actualización Correcta')
            ->details('Cliente'.' '. $cliente->Id_Afiliado.' '. 'Se Actualizó')
            ->button('Regresar a Listado de Clientes', '#', 'primary');

        return redirect('detalle-cliente/'.$cliente->Id_Afiliado);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //enviar correo de registro
    public function send($email,$nombre,$afiliado,$nip){
        $datos= array(

            'mail'    => $email,
            'nombre'  => $nombre,
            'cliente' => $afiliado,
            'nip'     => $nip
        );


        \Mail::send('emails.registrocliente',$datos,function($message)use($email,$nombre){

            //remitente
            $message->from('registro@healthypeopleco.com','Registro');
            //asunto
            $message->subject('Bienvenido');
            //receptor
            $message->to($email,$nombre);
        });

        return redirect()->route('clientes-lists');
    }

    public function redmultinivel(Request $request, $id){



        $date=Carbon::now();
        $date= $date->toDateString();

        $cliente=$this->clientRepository->findClient($id);

        $titleperiodo='Actual';

        if($request->periodo == null){

            $edocuenta= 'edo_cuenta';
        }
        else
        {
            $periodo=Periodo::find( $request->periodo);
            $edocuenta= $periodo->edocuenta;
            $titleperiodo= $periodo->fecha_inicio.' A '.$periodo->fecha_cierre;
        }

        //haciendo uso del repository ClientRepository
        $puntoscliente= $this->clientRepository->puntosClient($edocuenta,$id);
        $red=$this->clientRepository->redMultinivel($edocuenta,$id);
        $puntosgrupales= $red[0]->sum('Puntoscalificacion');
        $arraynivelesred= $red[1];
        $redes=$red[0];

        
//        //Se Obtiene la red desordenada del Afiliado= $id
//
//        $clientesred= \DB::table('clientes')
//            ->join($edocuenta, 'clientes.Id_Afiliado', '=', $edocuenta.'.'.'Id_Clientes_Afiliado')
//            ->select($edocuenta.'.'.'Id_Clientes_Afiliado','clientes.Id_Cliente_Patrocinador', 'clientes.nombre_completo', $edocuenta.'.'.'Id_Clientes_Padre',$edocuenta.'.'.'Id_Niveles_TipoNivel',$edocuenta.'.'.'Puntoscalificacion')
//            ->where($edocuenta.'.'.'Id_Clientes_Padre','=',$id)
//            ->orderBy($edocuenta.'.'.'Id_Niveles_TipoNivel', 'ASC')
//            ->get();
//
//        $puntoscliente= \DB::table($edocuenta)
//            ->select(
//                $edocuenta.'.'.'Puntoscalificacion',
//                $edocuenta.'.'.'Puntosnegocio',
//                $edocuenta.'.'.'Puntoshealthy')
//            ->where($edocuenta.'.'.'Id_Clientes_Afiliado','=',$id)
//            ->first();
//
//        //dd($clientesred);
//
//        //El array se convierte en una colección para poder hacer los filtros de nivel.
//        $clientesred= collect($clientesred);
//        $arraynivelesred= array();
//
//
//        $puntosgrupales= $clientesred->sum('Puntoscalificacion');
//
//
//       // dd($clientesred);
//
//        //Hacemos la consulta de los Afiliados por niveles y los almacenamos en  objetos de esas consultas
//
//        $clientesuno = $clientesred->filter(function($category) {
//            return $category->Id_Niveles_TipoNivel == 1 ? true : false;
//
//        });
//
//        array_push($arraynivelesred,$clientesuno);
//
//        //Consulta de todos los Afiliados del Nivel 2
//        $clientesdos=$clientesred->filter(function($category) {
//            return $category->Id_Niveles_TipoNivel == 2 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientesdos);
//
//        //Consulta de todos los Afiliados del Nivel 3
//        $clientestres = $clientesred->filter(function ($category) {
//            return $category->Id_Niveles_TipoNivel == 3 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientestres);
//
//        //Consulta de todos los Afiliados del Nivel 4
//        $clientescuatro = $clientesred->filter(function ($category) {
//            return $category->Id_Niveles_TipoNivel == 4 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientescuatro);
//
//        //Consulta de todos los Afiliados del Nivel 5
//        $clientescinco = $clientesred->filter(function ($category) {
//            return $category->Id_Niveles_TipoNivel == 5 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientescinco);
//
//        //Consulta de todos los Afiliados del Nivel 6
//        $clientesseis = $clientesred->filter(function ($category) {
//            return $category->Id_Niveles_TipoNivel == 6 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientesseis);
//
//        //Consulta de todos los Afiliados del Nivel 7
//        $clientessiete = $clientesred->filter(function ($category) {
//            return $category->Id_Niveles_TipoNivel == 7 ? true : false;
//        });
//
//        array_push($arraynivelesred,$clientessiete);
//
//        $arrayred= array();
//
//        foreach ($clientesuno as $niveluno)
//        {
//
//            //Obtenemos el Primer Afiliado en Nivel 1 y agregamos sus datos al array
//            $tmpNivel01=$niveluno->Id_Clientes_Afiliado;
//            array_push($arrayred, array(
//                "Afiliado"              => $niveluno->Id_Clientes_Afiliado,
//                "Patrocinador"          => $niveluno->Id_Cliente_Patrocinador,
//                "Nombre"                =>'.1-'.' '. $niveluno->nombre_completo,
//                "Puntoscalificacion"    =>$niveluno->Puntoscalificacion
//            ));
//
//            //Recorremos el resultado de la Consulta del nivel 2
//            foreach ($clientesdos as $niveldos)
//            {
//
//                //comparamos, si el patrocinador de los Afiliados que están en nivel 2 es igual al patrocinador del Afiliado tomado en Nivel 1
//                if ($tmpNivel01 == $niveldos->Id_Cliente_Patrocinador)
//                {
//
//                    $tmpNivel02 = $niveldos->Id_Clientes_Afiliado;
//                    //Si El Primer Afiliado del Nivel 1 es patrocinador de los afiliados consecuentes en nivel 2, los insertamos al arreglo.
//                    array_push($arrayred, array(
//                        "Afiliado"              => $niveldos->Id_Clientes_Afiliado,
//                        "Patrocinador"          => $niveldos->Id_Cliente_Patrocinador,
//                        "Nombre"                => '.      .      2-' . ' ' . $niveldos->nombre_completo,
//                        "Puntoscalificacion"    =>$niveldos->Puntoscalificacion
//                        ));
//
//                    foreach ($clientestres as $niveltres)
//                    {
//                        //comparamos, si el patrocinador de los Afiliados que están en nivel 3 es igual al patrocinador del Afiliado tomado en Nivel 2
//                        if ($tmpNivel02 == $niveltres->Id_Cliente_Patrocinador)
//                        {
//
//                            $tmpNivel03 = $niveltres->Id_Clientes_Afiliado;
//                            //Si El Primer Afiliado del Nivel 2 es patrocinador de los afiliados consecuentes en nivel 3, los insertamos al arreglo.
//                            array_push($arrayred, array(
//                                "Afiliado"              => $niveltres->Id_Clientes_Afiliado,
//                                "Patrocinador"          => $niveltres->Id_Cliente_Patrocinador,
//                                "Nombre"                => '.      .      .      3-' . ' ' . $niveltres->nombre_completo,
//                                "Puntoscalificacion"    =>$niveltres->Puntoscalificacion
//                            ));
//
//                            foreach ($clientescuatro as $nivelcuatro)
//                            {
//                                if($tmpNivel03== $nivelcuatro->Id_Cliente_Patrocinador)
//                                {
//
//                                    $tmpNivel04 = $nivelcuatro->Id_Clientes_Afiliado;
//                                    //Si El Primer Afiliado del Nivel 3 es patrocinador de los afiliados consecuentes en nivel 4, los insertamos al arreglo.
//                                    array_push($arrayred, array(
//                                        "Afiliado"              => $nivelcuatro->Id_Clientes_Afiliado,
//                                        "Patrocinador"          => $nivelcuatro->Id_Cliente_Patrocinador,
//                                        "Nombre"                => '.      .      .      .      4-' . ' ' . $nivelcuatro->nombre_completo,
//                                        "Puntoscalificacion"    =>$nivelcuatro->Puntoscalificacion
//                                    ));
//
//                                    foreach ($clientescinco as $nivelcinco)
//                                    {
//
//                                        if ($tmpNivel04 == $nivelcinco->Id_Cliente_Patrocinador)
//                                        {
//                                            $tmpNivel05 = $nivelcinco->Id_Clientes_Afiliado;
//                                            //Si El Primer Afiliado del Nivel 4 es patrocinador de los afiliados consecuentes en nivel 5, los insertamos al arreglo.
//                                            array_push($arrayred, array(
//                                                "Afiliado"              => $nivelcinco->Id_Clientes_Afiliado,
//                                                "Patrocinador"          => $nivelcinco->Id_Cliente_Patrocinador,
//                                                "Nombre"                => '.      .      .      .      .      5-' . ' ' . $nivelcinco->nombre_completo,
//                                                "Puntoscalificacion"    =>$nivelcinco->Puntoscalificacion
//                                            ));
//
//                                            foreach ($clientesseis as $nivelseis)
//                                            {
//                                                if ($tmpNivel05 == $nivelseis->Id_Cliente_Patrocinador)
//                                                {
//                                                    $tmpNivel06 = $nivelseis->Id_Clientes_Afiliado;
//                                                    //Si El Primer Afiliado del Nivel 5 es patrocinador de los afiliados consecuentes en nivel 6, los insertamos al arreglo.
//                                                    array_push($arrayred, array(
//                                                        "Afiliado"              => $nivelseis->Id_Clientes_Afiliado,
//                                                        "Patrocinador"          => $nivelseis->Id_Cliente_Patrocinador,
//                                                        "Nombre"                => '.      .      .      .      .      .      6-' . ' ' . $nivelseis->nombre_completo,
//                                                        "Puntoscalificacion"    => $nivelseis->Puntoscalificacion
//
//                                                ));
//
//                                                    foreach ($clientessiete as $nivelsiete)
//                                                    {
//                                                        if ($tmpNivel06 == $nivelsiete->Id_Cliente_Patrocinador)
//                                                        {
//                                                            //Si El Primer Afiliado del Nivel 6 es patrocinador de los afiliados consecuentes en nivel 7, los insertamos al arreglo.
//                                                            array_push($arrayred, array(
//                                                                "Afiliado"              => $nivelsiete->Id_Clientes_Afiliado,
//                                                                "Patrocinador"          => $nivelsiete->Id_Cliente_Patrocinador,
//                                                                "Nombre"                => '.      .      .      .      .      .      .      7-' . ' ' . $nivelsiete->nombre_completo,
//                                                                "Puntoscalificacion"    =>$nivelsiete->Puntoscalificacion
//                                                            ));
//
//                                                        }//---/if nivel siete
//                                                    }//---/foreach nivel siete
//                                                }//---/if nivel seis
//                                            }//---/foreach nivel sies
//                                        }//---/if nivel cinco
//                                    }//---/foreach nivel cinco
//                                }//---/if nivel cuatro
//                            }//---/foreach nivel cuatro
//                        }//---/if nivel tres
//                    }//---/foreach nivel tres
//                }//---/if nivel dos
//            }//---/foreach nivel dos
//        }//---/foreach nivel uno
//        
//        $redes= collect($arrayred);


       //dd($redes);

        //        dd($clientesuno->count());

       //dd($arraynivelesred);



        $submit = Input::all();
        
        if(isset($submit['red'])){
            //handle print process
            return \PDF::loadView('pdf.clienteredmultinivel',array(
                'cliente'           => $cliente, 
                'redes'             => $redes,
                'arraynivelesred'   => $arraynivelesred, 
                'titleperiodo'      => $titleperiodo,
                'date'              => $date
            ))
       ->stream('red.pdf');

        }
        if(isset($submit['edocuenta'])){
            //handle print process
            return \PDF::loadView('pdf.clienteedocuenta',array(
                'cliente'           => $cliente, 
                'redes'             => $redes,
                'arraynivelesred'   => $arraynivelesred,
                'titleperiodo'      => $titleperiodo,
                'date'              => $date
            ))
                ->stream('edocuenta.pdf');
        }
        
        return view('clientes.redmultinivel',compact('redes','cliente','titleperiodo','arraynivelesred','puntosgrupales','puntoscliente'));
        
    }

    public function redMultinivelPdf(Request $request,$id){


        $periodo= Input::get('periodo');


        dd($periodo);

//
//        dd($id);
//
//        $cliente=$this->clientRepository->findClient($id);
//
//
//
//        $titleperiodo='Actual';
//
//        if($periodo == null){
//
//            $edocuenta= 'edo_cuenta';
//        }
//        else
//        {
//            $periodo=Periodo::find($periodo);
//            $edocuenta= $periodo->edocuenta;
//            $titleperiodo= $periodo->fecha_inicio.' A '.$periodo->fecha_cierre;
//        }
//
//
//
//        //haciendo uso del repository ClientRepository
//        $puntoscliente= $this->clientRepository->puntosClient($edocuenta,$id);
//        $red=$this->clientRepository->redMultinivel($edocuenta,$id);
//        $puntosgrupales= $red[0]->sum('Puntoscalificacion');
//        $arraynivelesred= $red[1];
//        $redes=$red[0];
//
//        return \PDF::loadView('pdf.clienteredmultinivel',array('cliente' => $cliente, 'redes' => $redes,'arraynivelesred' => $arraynivelesred, 'titleperiodo' => $titleperiodo ))
//            ->stream('red.pdf');


        return view('partials.vistaprueba')->render();

    }
    
    
    public function datosclientemultinivel($id){
        
        
        dd($id);
        
        
        
    }

    public function getEstados(Request $request,$id){




        if($request->ajax()){
            $estadospais=Estado::states($id);
            return response()->json($estadospais);
        }
    }

    public function getCiudades(Request $request,$id){

        if($request->ajax()){

            $ciudades=Ciudad::allciudades($id);
            return response()->json($ciudades);
        }
    }





}
