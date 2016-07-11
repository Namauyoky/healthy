@extends('master')

@section('htmlheader_title')
    Descendencia
@endsection
@section('contentheader_title')
    Red Multinivel
@endsection
@section('contentheader_description')

@endsection

@section('main-content')

        <div class="row">
            <div class="col-md-2">
                <!-- Detalle de Afiliado Red -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('/dist/img/customer.png') }}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{ $cliente->nombre_completo }}</h3>
                        <p class="text-muted text-center">{{'Patrocinador:'.' '.$cliente->patrocinador->Id_Afiliado.' '.$cliente->patrocinador->nombre_completo }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Status Actual</b> <a class="pull-right">{{ $cliente->status->descripcion  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Puntos Calificación</b> <a class="pull-right">{{ $puntoscliente->Puntoscalificacion  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Puntos Negocio</b> <a class="pull-right">{{ $puntoscliente->Puntosnegocio  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Puntos Lealtad</b> <a class="pull-right">{{ $cliente->Puntos  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Puntos Negocio Grupales</b> <a class="pull-right">{{ $puntosgrupales}}</a>
                            </li>
                        </ul>


                        {{--<a href="#" class="btn btn-primary btn-block"><b>CRM</b></a>--}}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Descendencia</strong></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                        <div class="box-body">
                            {{--<div class="col-md-10">--}}
                            {{--<div class="container">--}}
                            {!! Form::model(Request::all(),['route' => ['redcliente',$cliente->Id_Afiliado],'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right','role' => 'Consultar' ]) !!}
                            <div class="form-group">
                                {!! Form::label('periodo','Periodo', array('class' => 'awesome')) !!}
                                {!! Form::select('periodo',$periodos,null,['class' => 'form-control','placeholder' => 'Seleccione...']) !!}
                                <button type="submit" class="btn btn-default" name="consultar" value="Consultar">Consultar</button>
                                <button type="submit" class="btn btn-default" name="red" value="Red" data-toggle="tooltip" title="Imprime Red">
                                    <i class="fa fa-code-fork"></i></button>
                                <button type="submit" class="btn btn-default" name="edocuenta" value="Edocuenta" data-toggle="tooltip" title="Imprime Estado de Cuenta">
                                    <i class="glyphicon glyphicon-briefcase"></i></button>
                                {!! Form::close() !!}
                            </div>
                            <h1 class="page-header">Periodo: {{  $titleperiodo }}</h1>
                            <div class="col-md-2">
                                <!-- Totales por nivel -->
                                <div class="box box-primary">
                                    <table class="table table-striped">
                                        {{--<table class="table table-striped">--}}
                                        {{--<table class="table table-hover table-striped table-bordered">--}}
                                        @include('clientes.partials.head-count-niveles')
                                        <tbody>
                                        @include('clientes.partials.list-count-niveles')
                                        </tbody>
                                    </table>
                                </div><!-- /.box -->
                            </div>

                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Cliente: {{ $cliente->Id_Afiliado.' '.$cliente->nombre_completo}}
                                </div>
                                <div class="panel-body">
                                    {{--<!-- Table -->--}}
                                    <div class="table-responsive">
                                        {{--<table data-toggle="table">--}}
                                        {{--<table class="table table-striped">--}}
                                        <table class="table table-hover table-striped table-bordered">
                                            @include('clientes.partials.head-red-cuenta')
                                            <tbody>
                                            @include('clientes.partials.list-red')
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <h5 class="box-title">
                                        {{--<a  data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                                        <span class="pull-right">
                                        {{--<a href="{{ url('redmultinivelpdf/'.$cliente->Id_Afiliado) }}"  data-field-id="{{$cliente->id}}"  id="red"  data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i></a>--}}
                                        {{--<a href="#" data-field-id="{{ $cliente->id }}" data-toggle="tooltip" type="button" id="red" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i></a>--}}
                                        {{----}}

                                        </span>

                                    </h5>

                                </div><!-- /.box-footer -->
                            </div>
                            {{--</div>--}}
                            {{--</div>--}}

                        </div><!-- ./box-body -->
                </div><!-- /.box -->
            </div>

    </div>

        <script>
            var userID = "{{ $cliente->Id_Afiliado }}";
        </script>


@endsection

@section('scripts')

    <script>
        $(function()
        {
            $('a.btn-line').click(function(event) {

                var id = event.target.id;

                $.ajax({

                    url:'detallemultinivel',
                    type:'GET',
                    data:"id=" + id ,

                    success: function(data) {
//                        $('#resultados').html(data);
//                        $('#resultados div').slideDown(1000);
                    }

                });


                //alert(id);
            });
        });
    </script>

@endsection


