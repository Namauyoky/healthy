<?php

namespace healthy\Http\Controllers;


use Faker\Provider\DateTime;
use healthy\Http\Requests\CreateClientRequest;
use healthy\Models\Clientes;
use healthy\Models\CountBank;
use healthy\User;
use Illuminate\Auth\Guard;

use healthy\Http\Requests;
use healthy\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;// Aquí indicamos que usaremos Carbon
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

 
    }
    
    public function nuevos(){

        $date=Carbon::now();
        $dateformated= $date->toDateString();

        $lastclients=Clientes::with('patrocinador')
            -> where('FechaAlta',"LIKE","%$dateformated%")
            -> orderBy('Id_Afiliado','DESC')
            ->get(array('Id_Afiliado','nombre_completo','Id_Cliente_Patrocinador'));

        return view('clientes.listanuevos',compact('lastclients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $states=['estados' => Estado::lists('Nombre_Estado','Id_Estado')];
       return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
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
            flash('Cliente Creado Correctamente')->important();
            //flash()->success('Cliente Creado Correctamente')->important();

            //$this->pdfClientRegister($cliente);
            
//            $this->send(
//                $request->mail,
//                $request->nombre. ' ' .$request->apellidos,
//                $cliente->Id_Afiliado,
//                $cliente->Nip
//            );

            //Envío de Correo de Confirmación a Cliente.
            \Mail::send('emails.registrocliente',$cliente->toArray(),function($message)use($cliente){

                //remitente
                $message->from('registro@healthypeopleco.com','Registro');
                //asunto
                $message->subject('Bienvenido');
                //receptor
                $message->to($cliente->Correo_Electronico, $cliente->nombre_completo);
                
            });
            
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    
}
