
@extends('master')

@section('htmlheader_title')
    Afiliados
@endsection

@section('contentheader_title')
    Alta
@endsection
@section('contentheader_description')
    Nuevo Afiliado
@endsection

@section('main-content')

    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">Datos Generales del Afiliado</div>
            <div class="panel-body">

                {!! Form::model($makeForm,['route' => 'alta-cliente','method' =>'POST','class' => 'form-horizontal','role' => 'form', 'id' => 'search']) !!}

                @include('partials/errors')

                <div class="form-group">
                    <label for="redorigen" class="col-sm-2 control-label">Red Origen</label>
                    <div class="form-group">
                        <div class="col-sm-2">
                            {!! Form::select('red',$red,null,['class' =>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="patrocinador" class="col-sm-1 control-label">Patrocinador</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="Clave Patrocinador" name="patrocinador" id="patrocinador" value="{{ old('patrocinador') }}">
                            </div>
                            <div class="col-sm-1" >
                                <button type="button" class="form-control" id="buscar">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <table class="table table-hover table-striped" id="tblAfiliados" style="display: none">

                                <tbody>
                                <tr>
                                    <th class="id"></th>
                                    <th class="nombre"></th>

                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Nombre Afiliado" name="nombre" value="{{ old('nombre') }}"></div>
                    <label class="col-sm-1 control-label">Apellidos</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Apellidos Afiliado" name="apellidos" value="{{ old('apellidos') }}"></div>
                    <label class="col-sm-1 control-label">Fecha de Nacimiento</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" value="{{old('nacimiento')}}">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="pais_id" class="col-sm-2 control-label">País</label>
                    <div class="col-sm-2">
                        {!! Field::select('pais_id',$paises,['class' => 'form-control','id' => 'pais_id']) !!}</div>
                    <label for="estado_id" class="col-sm-1 control-label">Estado</label>
                    <div class="col-sm-2">
                        {!! Field::select('estado_id',$paisEstados,['class' => 'form-control','id' => 'estado_id']) !!}</div>
                    <label for="ciudad_id" class="col-sm-1 control-label">Ciudad</label>
                    <div class="col-sm-2">
                        {!! Field::select('ciudad_id',$ciudades,['class' => 'form-control','id' => 'ciudad_id']) !!}</div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="identificacion" class="col-sm-2 control-label">ID/Identificación</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="No. Identificación" name="identificacion" value="{{ old('identificacion') }}"></div>
                    <label class="col-sm-1 control-label">RFC/CURP/SSN</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="rfc" value="{{ old('rfc') }}"></div>
                </div>
                <hr>


                <div class="form-group">
                    <label for="genero" class="col-sm-2 control-label">Género</label>
                    <div class="col-sm-2">
                        {!! Form::select('genero',['Masculino' =>'Masculino','Femenino' => 'Femenino'],null,['class' => 'form-control']) !!}
                    </div>

                    <label for="edocivil" class="col-sm-1 control-label">Estado Civil</label>
                    <div class="col-sm-2">

                        {!! Form::select('edocivil',['Soltero' =>'Soltero','Casado' => 'Casado', 'Viudo' => 'Viudo', 'Divorciado' => 'Divorciado'],null,['class' => 'form-control']) !!}

                    </div>

                    <label for="ocupacion" class="col-sm-1 control-label">Ocupación</label>
                    <div class="col-sm-2">
                        {!! Form::select('ocupacion',[

                        'Comerciante'   =>'Comerciante',
                        'Distribuidor'  => 'Distribuidor',
                        'Empleado'      => 'Empleado',
                        'Hogar'         => 'Hogar',
                        'Estudiante'    => 'Estudiante',
                        'Profesionista' => 'Profesionista',
                        'Otro'          => 'Otro'

                        ],null,['class' => 'form-control']) !!}

                        </div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Domicilio</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Calle y No." name="domicilio" value="{{ old('domicilio') }}"></div>
                    <label class="col-sm-1 control-label">Colonia</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Colonia" name="colonia" value="{{ old('colonia') }}"></div>
                    <label class="col-sm-1 control-label">Código Postal</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="codigop" value="{{old('codigop')}}">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-2">
                        <input type="tel" class="form-control" placeholder="000-000-0000" name="telefono" value="{{ old('telefono') }}"></div>
                    <label class="col-sm-1 control-label">Celular</label>
                    <div class="col-sm-2">
                        <input type="tel" class="form-control" placeholder="000-000-0000" name="celular" value="{{ old('celular') }}"></div>
                    <label class="col-sm-1 control-label">E-mail</label>
                    <div class="col-sm-3">
                        <input type="email" class="form-control" name="mail" value="{{old('mail')}}">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="identificacion" class="col-sm-2 control-label">Banco</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Banco" name="banco" value="{{ old('banco') }}"></div>
                    <label class="col-sm-1 control-label">Cuenta</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="No. de Cuenta" name="cuenta" value="{{ old('cuenta') }}"></div>
                </div>

                <div class="form-group">
                    <label for="tipopago" class="col-sm-2 control-label">Tipo Pago</label>
                    <div class="col-sm-3">

                        {!! Form::select('tipopago',[

                       'Depósito'      => 'Depósito',
                       'Factura'       => 'Factura',
                       'Tarjeta'       => 'Tarjeta',
                       'Checking'      => 'Checking',
                       'Saving'        => 'Saving'
                       ],null,['class' => 'form-control']) !!}

                    </div>

                    <label for="idimpuesto" class="col-sm-1 control-label">Retención</label>
                    <div class="form-group">
                        <div class="col-sm-3">
                            {!! Form::select('impuestos',$impuestosretener,null,['class' =>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-info pull-right">Register</button>
                    </div><!-- /.col -->
                </div>
            </div>

            {{--</form>--}}
            {!! Form::close() !!}

        </div>
    </div>

    </div>
@endsection


{{--@include('partials.jqueryscript')--}}
@section('scripts')
@include('scripts jquery.altaclientes')
@endsection
{{--@include('partials.scripts')--}}

{{--    <fieldset disabled>
        <div class="form-group">
            <label for="disabledTextInput" class="col-sm-2 control-label">Disabled input and select list (Fieldset disabled)</label>
            <div class="col-sm-10">
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
            </div>
        </div>
        <div class="form-group">
            <label for="disabledSelect" class="col-sm-1 control-label">frdhhg</label>
            <div class="col-sm-10">
                <select id="disabledSelect" class="form-control">
                    <option>Disabled select</option>
                </select>
            </div>
        </div>
    </fieldset>--}}

{{--<div class="form-group">--}}
{{--<label class="col-sm-12">Phone number</label>--}}
{{--<div class="col-sm-1"><input type="text" class="form-control" placeholder="000"><div class="help">area</div></div>--}}
{{--<div class="col-sm-1"><input type="text" class="form-control" placeholder="000"><div class="help">local</div></div>--}}
{{--<div class="col-sm-2"><input type="text" class="form-control" placeholder="1111"><div class="help">number</div></div>--}}
{{--<div class="col-sm-2"><input type="text" class="form-control" placeholder="123"><div class="help">ext</div></div>--}}
{{--</div>--}}



