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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;// Aquí indicamos que usaremos Carbon
use Illuminate\Support\Facades\Session; 

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
        $date=Carbon::now();
        $dateformated= $date->toDateString();

        $lastclients=Clientes::where('FechaAlta',"LIKE","%$dateformated%")
                    ->orderBy('Id_Afiliado','DESC')
                    ->get();

        return view('clientes.lists',compact('lastclients'));
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
        //



//        //Opcion sin usar Request
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
            //$fechactual= new DateTime('now');
            $cliente->FechaAlta=$dateformated;
            $cliente->Fecha_ultcompra=$dateformated;
            $cliente->Puntos=0;
            $cliente->Estado_Cliente=2;
            $cliente->Tipo_ImpuestoRetener=$request->impuestos;
            $cliente->Id_Usuarios_UsuarioAlta=$auth->id();
            $cliente->Id_RedOrigen='MX';
            $cliente->Tipo_Cliente=1;
            $cliente->save();


            //$hijo=$idcreado->Id_Afiliado;

            //$hijo=$cliente->Id_Afiliado=16;
            
            
            CountBank::create(array(
               
                'Id_Afiliado' => $cliente->Id_Afiliado,
                'banco'       => $request->banco,
                'cuenta'      => $request->cuenta,
                'tipopago'    => $request->tipopago

            ));

            \DB::select('CALL Multinivel(?,?)',array($padre,$cliente->Id_Afiliado));
            \DB::commit();

//            Session::flash('flash_message','Cliente Creado Correctamente');
            //otra opcion
        /*    session()->flash('flash_message','Cliente Creado Correctamente');
            session()->flash('flash_message_important',true);*/

            /*Para esta opcion se tiene que agregar el paquete laracasts/flash en composer
            /*Recibe como parámetros flash.message y flash.level(éste para saber el nivel de importancia)
            /*En clase FlashNotifier
            */

            //si no queremos usar laracasts/flash, descomentar /comentar
            //flash('Cliente Creado Correctamente')->important();
            flash()->success('Cliente Creado Correctamente');

            //Flash Modal
//            flash()->overlay('Cliente Creado Correctamente','Proceso Correcto');

            return redirect()->route('clientes-lists');

            //Algo más resumido
//            return redirect()->route('clientes-lists')->with([
//
//                'flash_message' => 'Cliente Creado Correctamente',
//                'flash_message_important' => true
//            ]);

        }
            // Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
            \DB::rollback();
            // no se... Informemos con un echo por ejemplo

            //return 'Error de Datos'.'ERROR (' . $e->getCode() . '): ' . $e->getMessage();

            return redirect()->to('alta-cliente')
                ->withErrors($e->getMessage())
                ->withInput(\Input::all());
        }

        // Hacemos los cambios permanentes ya que no han habido errores





        




        //Opcion sin simplificación
//        $rules= array(
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
//        );
//
//        $this->validate($request,$rules);
        //-------------------------------------
        //Sin usar el método validate
        /*
         *$data = Request::all();
         * $rules= array();
         * $v= Validator::make($data,$rules);
         * if($v->fails()){
         * return redirect()->back()
         * ->withErrors($v->errors())
         * ->withInput(Request::except('password'))
         * $user = User::create($data);
         * return redirect()->route('users.index');
         *}
         */

 /*       $nota= new Note();
        $nota->note= $request->get('campo de formulario');
        $nota->save();*/




        // dd($request->all());

//        $request=Request::all();
//
//        return $request;
        //return "Entró";


        // return Request::only
        //$data= request()->all();

        //Clientes::create($data);

        //return redirect::to('notes');
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
}
