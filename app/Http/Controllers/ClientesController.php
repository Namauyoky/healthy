<?php

namespace healthy\Http\Controllers;

use healthy\Http\Requests\CreateClientRequest;
use healthy\Models\Clientes;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use healthy\Http\Requests;
use healthy\Http\Controllers\Controller;

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
        return view('clientes.lists');
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

            $cliente=new Clientes($request->all());

            $hijo=$cliente->Id_Afiliado=15;
            $cliente->Estado_Cliente=2;
            $cliente->Id_Usuarios_UsuarioAlta=$auth->id();
            $cliente->FechaAlta='2016-06-16';
            $cliente->Tipo_ImpuestoRetener=1;
            $padre=$cliente->Id_Cliente_Patrocinador=4;
            $cliente->Sexo='Femenino';
            $cliente->EdoCivil='Soltero';
            $cliente->Ocupacion='Empleado';
            $cliente->NoSeguro='200';
            $cliente->RFC='MOLJ55454';
            $cliente->Fecha_ultcompra='2016-03-18';
            $cliente->retencion_isr=1;
            $cliente->Id_Cliente_Patrocinador_ant=6;
            $cliente->Puntos=0;
            $cliente->Id_RedOrigen='MX';
            $cliente->Tipo_Cliente=1;
            $cliente->Id_Ciudades_Ciudad= $request->ciudad_id;
            $cliente->Id_Estados_Estado= $request->estado_id;
            $cliente->Id_Paises_Pais=$request->pais_id;
            $cliente->Nombre=$request->nombre;
            $cliente->Apellidos= $request->apellidos;
            $cliente->save();


            \DB::select('CALL Multinivel(?,?)',array($padre,$hijo));
            \DB::commit();

            return redirect()->route('clientes-lists');

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
