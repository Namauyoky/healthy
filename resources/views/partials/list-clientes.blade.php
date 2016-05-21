@extends('master')


@section('main-content')
<table class="table table-hover table-striped">

    @include('partials.head-clientes')
    <tbody>

@foreach($clients as $client)


    <tr>
        <td>{{ $client->Id_Afiliado }}</td>
        <td>{{ $client->nombre_completo }}</td>
        <td>{{ $client->Domicilio }}</td>
        <td>{{ $client->Colonia }}</td>
        <td>{{ $client->Fecha_Nacimiento }}</td>

    </tr>
@endforeach
    </tbody>
</table>
    @endsection



