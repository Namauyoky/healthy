@extends('master')

@section('htmlheader_title')
    Afiliados
@endsection
@section('contentheader_title')
    Consulta
@endsection
@section('contentheader_description')
    Muestra los últimos 100 Afiliados Registrados
@endsection

@section('main-content')

    <div class="container">

        {!! Form::open(['route' => 'clientes','method' => 'GET', 'class' => 'navbar-form navbar-left pull-right','role' => 'search' ]) !!}
            <div class="form-group">
                {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Nombre de Afiliado...']) !!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
        {!! Form::close() !!}
        <h1 class="page-header">
            Lista de Afiliados
        </h1>
        <p>
        {{ $clients->total() }} Registros |
        Página {{ $clients->currentPage()  }}
        de {{ $clients->lastPage() }}
        </p>

        <table class="table table-hover table-striped"  id="catalogoClientes">

            @include('partials.head-clientes-consulta')
            <tbody>
            @include('partials.list-clientes-consulta')
            </tbody>
        </table>

        {!! $clients->render() !!}
    </div>

@endsection

