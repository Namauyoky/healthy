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
use healthy\Note;
use healthy\Http\Requests\Request;
use healthy\Ciudad;
use healthy\Estado;
use healthy\Pais;


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

    //Alta de Clientes
    Route::get('alta-cliente',[

        'uses' => 'ClientesController@create',
        'as'   => 'alta-cliente'
    ]);

    Route::post('alta-cliente',[

     'uses' => 'ClientesController@store',
     'as'   => 'altacliente'
    ]);



    Route::get('paisestados/{Id_Pais}',function($Id_Pais){

        //RETORNAR LA CONSULTA AL MODELO
        $estados=PaisEstado::where('Id_Paises_Pais',$Id_Pais)
            ->select('Id_Estado as value','Nombre_Estado as text')
            ->orderBy('Nombre_Estado','ASC')
            ->get()
            ->toArray();

        array_unshift($estados,['value' =>'','text' =>'Seleccione']);
        return $estados;

    });

    Route::get('ciudades/{Id_Estado}',function($Id_Estado){
        $ciudades=Ciudad::where('Id_Estados_Estado',$Id_Estado)
            ->select('Id_Ciudad as value','Nombre_Ciudad as text')
            ->orderBy('Nombre_Ciudad','ASC')
            ->get()
            ->toArray();

        array_unshift($ciudades,['value' =>'','text' =>'Seleccione']);
        return $ciudades;

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


Route::resource('estados','EstadoController');


//Middleware para accesar a diferentes rutas, sólo si el usuario está registrado en el sistema, hizo login




//
//    Route::group(['middleware' => 'verified'],function(){
//
//
//        Route::get('publish',function(){
//
//            return view('publish');
//        });
//
//        Route::post('publish',function(){
//
//            return Request::all();
//
//        });
//
//
//    });



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




