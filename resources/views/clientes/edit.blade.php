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
            <div class="panel-heading">Editar Cliente/ {{ $cliente->Id_Afiliado.' ' .$cliente->nombre_completo }}
            </div>
            <div class="panel-body">
                {!! Form::model($cliente,['route' => ['update-cliente',$cliente->Id_Afiliado],'method' =>'PUT','class' => 'form-horizontal','role' => 'form', 'id' => 'search']) !!}
                @include('partials/errors')

                {{--Referencia --}}
                <div class="form-group">
                    {!! Form::label('Red','Red Origen',['class' => 'col-sm-2 control-label']) !!}
                    <div class="form-group">
                        <div class="col-sm-2">
                            {!! Form::select('red',$redorigen,$cliente->red->Id_redorigen,['class' =>'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('patrocinador','Patrocinador',['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('patrocinador',$cliente->Id_Cliente_Patrocinador.' '.$cliente->patrocinador->nombre_completo ,['class' => 'form-control','disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- Nombre --}}
                <div class="form-group">
                    {!! Form::label('Nombre','Nombre',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {{--<input type="text" class="form-control" placeholder="Nombre Afiliado" name="Nombre" value="{{ old('nombre') }}">--}}
                        {!! Form::text('Nombre',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('Apellidos','Apellidos',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('Apellidos',null,['class' => 'form-control']) !!}</div>
                    {!! Form::label('nacimiento','Fecha de Nacimiento',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::date('Fecha_Nacimiento',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                {{--Generales --}}
                <div class="form-group">
                    {!! Form::label('identificacion','Identificación',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('Identificacion',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('rfc','RFC/CURP/SSN',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('RFC',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    {!! Form::label('genero','Género',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('Genero',['Masculino' =>'Masculino','Femenino' => 'Femenino'],null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('edocivil','Edo.Civil',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('EdoCivil',['Soltero' =>'Soltero','Casado' => 'Casado', 'Viudo' => 'Viudo', 'Divorciado' => 'Divorciado'],null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('ocupacion','Ocupación',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('Ocupacion',[
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
                {{--Ubicación --}}
                <div class="form-group">
                    {{--<label for="pais_id" class="col-sm-2 control-label">País</label>--}}
                    {!! Form::label('pais_id','País',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('pais_id',$paises,$cliente->Id_Paises_Pais, ['class' => 'form-control','id' => 'pais_id']) !!}
                    </div>
                    {!! Form::label('estado_id','Estado',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('estado_id',$paisEstados,null, ['class' => 'form-control','id' => 'estado_id']) !!}
                    </div>
                    {!! Form::label('ciudad_id','Ciudad',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('ciudad_id',$ciudades,null,['class' => 'form-control','id' => 'ciudad_id']) !!}
                    </div>
                </div>
                <hr>
                {{--Domicilio --}}
                <div class="form-group">
                    {!! Form::label('domicilio','Domicilio',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('Domicilio',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('colonia','Colonia',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('Colonia',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('codigopostal','Código Postal',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('CodigoPostal',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                {{--Contacto--}}
                <div class="form-group">
                    {!! Form::label('telefono','Teléfono',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('Telefono',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('celular','Celular',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-2">
                        {!! Form::text('Tel_Celular',null,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('email','E-mail',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::email('Correo_Electronico',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                {{--Cuenta Banco --}}
                <div class="form-group">
                    {!! Form::label('banco','Banco',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('Banco',$cliente->cuentabanco->banco,['class' => 'form-control']) !!}
                    </div>
                    {!! Form::label('cuenta','No. Cuenta',['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('cuenta',$cliente->cuentabanco->cuenta,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tipopago','Tipo de Pago',['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">

                        {!! Form::select('tipopago',[

                       'Depósito'      => 'Depósito',
                       'Factura'       => 'Factura',
                       'Tarjeta'       => 'Tarjeta',
                       'Checking'      => 'Checking',
                       'Saving'        => 'Saving'
                       ],$cliente->cuentabanco->tipopago,['class' => 'form-control']) !!}

                    </div>
                    {!! Form::label('idimpuesto','Retención',['class' => 'col-sm-1 control-label']) !!}
                    <div class="form-group">
                        <div class="col-sm-3">
                            {!! Form::select('impuestos',$impuestosretener,$cliente->clienteimpuesto->idimpuesto_retener,['class' =>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-info pull-right">Actualizar</button>
                    </div><!-- /.col -->
                </div>
            </div>
            {{--</form>--}}
            {!! Form::close() !!}

        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

                        $.fn.populateSelect= function (values) {

                            var options='';

                            $.each(values,function (key,row) {


                                    options+= '<option value="' + row.value +  '"> ' + row.text +  '</option>';
                            });
                            //this representa el objeto select
                            $(this).html(options);
                        };


                        $('#pais_id').change(function () {
                            $('#ciudad_id').empty();
                            $('#estado_id').empty();

                            var pais_id= $(this).val();
                            LlenaEstados(pais_id);

                        }).trigger('change');


                        $('#estado_id').change(function () {
                            var estado_id= $('#estado_id').val();

                            LlenaCiudades(estado_id);
                        }).trigger('change');


        });//fin ready function


        $(window).load(function (){

            var estadocliente="{{  $cliente->Id_Estados_Estado }} ";

            LlenaCiudades(estadocliente);
        });


        function LlenaEstados(pais_id){

            if(pais_id==''){
                $('#estado_id').empty();
            }else{

                $.getJSON('/paisestados/'+pais_id,null,function (values) {
//                                    $('#estado_id').populateSelect(values);
                    var options='';
                    $.each(values,function (key,row) {

                        if(row.value=="{{ $cliente->Id_Estados_Estado }}" ){
                            options+= '<option value="' + row.value +  '" selected="selected"> ' + row.text +  '</option>';
                            LlenaCiudades(row.value);
                        }
                        else {
                            options+= '<option value="' + row.value +  '"> ' + row.text +  '</option>';
                        }
                    });
                    //this representa el objeto select
                    $('#estado_id').html(options);
                });
            }
        }


        function LlenaCiudades(estado_id){

            //Esto seria aigual a var estado_id= $estado_id.val()
            if(estado_id==''){
                $('#ciudad_id').empty();
            }else{

                $.getJSON('/ciudades/'+estado_id,null,function (values) {
                    var options='';
                    $.each(values,function (key,row) {

                        if(row.value=="{{ $cliente->Id_Ciudades_Ciudad }}" ){

                            options+= '<option value="' + row.value +  '" selected="selected"> ' + row.text +  '</option>';
                        }
                        else {
                            options+= '<option value="' + row.value +  '"> ' + row.text +  '</option>';
                        }
                    });
                    //this representa el objeto select
                    $('#ciudad_id').html(options);

                });
            }
        }


    </script>

@endsection