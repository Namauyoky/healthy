<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Bican\Roles\Models\Permission;
use healthy\Models\Clientes;
use healthy\Note;
use healthy\Models\Ciudad;
use healthy\Models\Estado;
use healthy\Models\Pais;
use healthy\User;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\App;
use Yajra\Datatables\Datatables;


//Rutas sólo usuarios logueados...

Route::group(['middleware' =>'auth'],function(){


        Route::get('/', function () {
            return view('home');
        });
        
        Route::get('logout',[

            'uses' => 'Auth\AuthController@getLogout',
            'as'  => 'logout'
        ]);

        //Registration routes
        Route::get('registro',[
            'uses' => 'Auth\AuthController@getRegister',
            'as'   => 'registro'
        ]);

        Route::post('registro',[

            'uses' => 'Auth\AuthController@postRegister',
            'as'  => 'registro'
        ]);


            //Consulta General Clientes
            Route::get('clientes',[

                'uses'   => 'ClientesController@index',
                'as'     => 'clientes'
            ]);

            Route::get('detalle-cliente/{id}',[

                'uses'  => 'ClientesController@show',
                'as'    => 'detalle-cliente'

            ]);

            Route::get('edit-cliente/{id}',[
                'uses'   => 'ClientesController@edit',
                'as'    => 'edit-cliente'

            ]);

            Route::put('update-cliente/{id}',[

                'uses'  => 'ClientesController@update',
                'as'    => 'update-cliente'
            ]);

            //Alta de Clientes(Formulario)
            Route::get('alta-cliente',[

                'uses'       => 'ClientesController@create',
                'middleware' => 'role:admin',
                'as'         => 'alta-cliente'
            ]);
            //Alta de Clientes(Store)
            Route::post('alta-cliente',[

                'uses' => 'ClientesController@store',
                'as'   => 'alta-cliente'
            ]);
            //Muestra Lista de Ultimos Registrados
            Route::get('cliente-list',[

                'uses' =>'ClientesController@nuevos',
                'as' => 'clientes-lists'
            ]);
            //Para Buscar Cliente(Para Patrocinador o Ventas)
            Route::get('consultacliente',[

                'as' => 'consultacliente',
                'uses' => 'ClientesController@consultaname'
            ]);
            //ruta que devuelve un json con los usuarios de la base de datos
            Route::get('buscacliente', function(){

                if(Request::ajax())
                {
                    $buscar= Request::input('data');
                    //$users = DB::table('users')->get();
                    $clientes= Clientes::where('nombre_completo',"LIKE","%$buscar%")->get();

                    return Response::json(array(
                        'clientes' => 	$clientes
                    ));
                }
            });


        Route::get('redmultinivel/{id}',[
            
            'as'    => 'redcliente',
            'uses'  => 'ClientesController@redmultinivel'
            
        ]);

        Route::get('detallemultinivel/{id}',[
        
            'as'    => 'detallemultinivel',
            'uses'  => 'ClientesController@datosclientemultinivel'
            
        ]);
    
//        Route::get('redmultinivelpdf/{id}/{periodo}','ClientesController@redMultinivelPdf');

        Route::get('redmultinivelpdf/{id}',[

            'as'   => 'redmultinivelpdf',
           'uses'  => 'ClientesController@redMultinivelPdf'

        ]);


//        Route::get('pdf-cliente',[
//
//            'uses' => 'ClientesController@index',
//            'as'   => 'pdf-cliente'
//        ]);


        //Para Select de Región...
        Route::get('paisestados/{pais_id}',function($pais_id){

            //RETORNAR LA CONSULTA AL MÉTODO.
            $estados= Estado::where('Id_Paises_Pais',$pais_id)
                ->select('Id_Estado as value','Nombre_Estado as text')
                ->orderBy('Nombre_Estado','ASC')
                ->get()
                ->toArray();

            array_unshift($estados,['value' =>'','text' => 'Seleccione']);
            return $estados;
        });

        Route::get('ciudades/{estado_id}',function($estado_id){
            $ciudades=Ciudad::where('Id_Estados_Estado',$estado_id)
                ->select('Id_Ciudad as value','Nombre_Ciudad as text')
                ->orderBy('Nombre_Ciudad','DESC')
                ->get()
               ->toArray();

           array_unshift($ciudades,['value' =>'','text' =>'Seleccione']);
            return $ciudades;
        });
    
    
        


        Route::get('estados/{id}','ClientesController@getEstados');
    


    Route::get('ciudades/{id}','ClientesController@getCiudades');

        Route::get('clienteregistro/{id}','PdfController@altacliente');
        
        Route::get('/crearole',function(){

           $adminRole= Role::create([

               'name' =>'Administrador',
               'slug' =>'admin',
               'description' =>'Acceso completo',
           ]);
        });

        Route::get('/setrole',function(){


            $user= User::find(5);

            $user->attachRole(1);
        });

        Route::get('/createpermiso',function(){

            $createClientPermission= Permission::create([

                'name' => 'Create cliente',
                'slug' => 'create.cliente',
                'description' => 'Crear Afiliado',
            ]);
        });
        
        Route::get('/permisorole',function(){

            $role= Role::find(1);
            $role->attachPermission(2);
        });


        
        





});





/*Route::get('notes',function(){

    $notes=Note::all();

    return view('notes/list',compact('notes'));
});
Route::get("usuario/{nombre}",function($usuario)){

echo "Hola: ".$usuario;
return "Hola: ".$usuario;

Imprime Hola : jorge
}

Route::get("pagina",function()){
return view("pagina.index");    ("directorio/archivo")= ("directorio.archivo")

}

Route::get("pagina/{numero}",function($numero)){

return view("pagina.index")->with("n",$numero);   ->with("asi lo reconocemos en la vista",variable)
}


*/

Route::get('notes','NotesController@index');
Route::post('notes','NotesController@store');
Route::get('notes/create','NotesController@create');
Route::get('notes/{note}','NotesController@show')->where('note','[0-9]+');
Route::get('usuarios/create','UserController@create');
Route::get('productos',function()
{

    $productos= healthy\Productos::all();
    return $productos;

});
Route::get('productos/create',function()
{

    $productos= new healthy\Productos;

    $productos->Id_Producto=3004;
    $productos->Nombre="Goji-Man";
    $productos->Descripcion="Una Rica fuente de vida y Salud";
    $productos->PiezasXCaja=10;
    $productos->Id_Categorias_Categoria=1;
    $productos->Id_Proveedores_Proveedor=1;
    $productos->EsPaquete=1;
    $productos->DisponibleVenta=1;
    $productos->DesglosaContenido=1;
    $productos->VentaPuntos=1;
    $productos->DisponibleEcommerce=1;
    $productos->save();

});
Route::get('productos/edit',function()
{

    $productos= healthy\Productos::find(3004);

    //$productos->Id_Producto=3004;
    //$productos->Nombre="Goji-Man";
    $productos->Descripcion="Una Rich fuente de vida y Salud para el Ser Humano";
    $productos->PiezasXCaja=20;
    //$productos->Id_Categorias_Categoria=1;
    //$productos->Id_Proveedores_Proveedor=1;
    $productos->EsPaquete='1';
    //$productos->DisponibleVenta=1;
    //$productos->DesglosaContenido=1;
    $productos->VentaPuntos='1';

    //$productos->DisponibleEcommerce=1;
    $productos->save();

});
Route::get('productos/delete',function()
{

    $productos= healthy\Productos::find(3003);
    $productos->delete();

});






/*Autentication Routes
 *
 * Estas rutas no están delimitadas dentro del middleware, porque para poder entrar al sistema, es necesario entrar a estas
 * rutas.
 */

Route::get('login',[


    'uses' => 'Auth\AuthController@getLogin',
    'as'   => 'login'

]);

Route::post('login',[


    'uses' => 'Auth\AuthController@postLogin',
    'as'   => 'login'
]);




