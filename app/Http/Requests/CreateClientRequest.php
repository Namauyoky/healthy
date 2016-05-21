<?php

namespace healthy\Http\Requests;

use healthy\Http\Requests\Request;

class CreateClientRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'nombre'              =>'required|max:40|string',
            'apellidos'         =>'required|max:50|string',
            'nacimiento'        =>'required|date',
            'pais_id'           =>'required|not in:Seleccione',
            'estado_id'         =>'required|not in:Seleccione',
            'ciudad_id'         =>'required||not in:Seleccione',
            'identificacion'    =>'required|max:255|alpha_num',
            'rfc'               =>'required|max:18|alpha_num',
            'genero'            =>'required|in:Masculino,Femenino',
            'edocivil'          =>'required|in:Soltero,Casado,Viudo,Divorciado',
            'ocupacion'         =>'required|in:Comerciante,Distribuidor,Empleado,Hogar,Estudiante,Profesionista,Otro',
            'domicilio'         =>'required|max:150|string',
            'colonia'           =>'required|max:50|string',
            'codigop'           =>'required|max:6|digits:6',
            'telefono'          =>'required|max:30|alpha_num',
            'celular'           =>'max:30|alpha_num',
            'mail'              =>'required|email',
            'banco'             =>'required',
            'cuenta'            =>'required'



        ];
    }
}
