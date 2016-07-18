@extends('master')

@section('htmlheader_title')
    CRM
@endsection
@section('contentheader_title')
    Customer Relationship Management
@endsection
@section('contentheader_description')

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>CRM</strong></h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    @include('clientes.partials.formcrmgenerales')
                    @include('clientes.partials.formcrminfored')

                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Histórico de Resultados
                                <a data-toggle="collapse" href="#panelhistorico" class="box-tools pull-right"><i class="fa fa-minus"></i></a>
                            </h4>
                        </div>

                        <div id="panelhistorico" class="panel-collapse collapse">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    @include('partials.head-historicocliente')
                                    <tbody>
                                    @include('partials.list-historicocliente')
                                    </tbody>
                                </table>
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
                    </div>

                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Pedidos
                                    <a data-toggle="collapse" href="#panelventas" class="box-tools pull-right"><i class="fa fa-minus"></i></a>
                            </h4>
                        </div>

                        <div id="panelventas" class="panel-collapse collapse">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    @include('partials.head-pedidosclientes')
                                    <tbody>
                                    @include('partials.list-pedidosclientes')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
        });
    </script>

@endsection


