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
use healthy\Repositories\PeriodsRepository;
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
    private $periodsRepository;

    public function __construct(ClientRepository $clientRepository,PeriodsRepository $periodsRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->periodsRepository= $periodsRepository;
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

    public function crmclient($id){

        $cliente= $this->clientRepository->findClient($id);
        $pedidos= $this->clientRepository->pedidosClient($id);
        $periods= $this->periodsRepository->periods();
        $historicperiods= array();

        foreach ($periods as $period){

            $tableedocuenta=$period->edocuenta;
            $tablecommissions=$period->comisiones;
            $redes=$this->clientRepository->redMultinivel($tableedocuenta,$id);
            $puntosclient=$this->clientRepository->puntosClient($tableedocuenta,$id);
            $commissionesclient=$this->clientRepository->comissionsclient($tablecommissions,$id);
            $rango=$this->clientRepository->rangoClient($id,$period->Id);

            
            array_push($historicperiods,array(
                "Periodo"               => $period->periodo,
                "CalificacionPersonal"  =>$puntosclient->Puntoscalificacion,
                "Comisiones"            =>$commissionesclient->ganancia,
                "AfiliadosRed"          =>$redes[0]->count(),
                "ComprasRed"            =>$redes[0]->sum('Puntoscalificacion'),
                "PrimerNivel"           =>$redes[1][0]->count(),
                "SegundoNivel"          =>$redes[1][1]->count(),
                "Rango"                 =>$rango,
                "PuntosCompra"          =>$puntosclient->Puntoshealthy,
                "PuntosRango"           =>$commissionesclient->puntosrango
            ));
        }
        
        return view('clientes.crm',compact('cliente','pedidos','historicperiods'));
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
