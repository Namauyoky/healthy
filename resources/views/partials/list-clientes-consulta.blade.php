@foreach($clients as $client)
    <tr>
        <td>{{ $client->Id_Afiliado }}</td>
        <td>{{ $client->Nombre }}</td>
        <td>{{ $client->Apellidos }}</td>
        <td>{{ $client->Id_Cliente_Patrocinador.' '.$client->patrocinador->nombre_completo  }}</td>
        <td>{{ $client->Telefono }}</td>
        <td>{{ $client->Correo_Electronico }}</td>
        <td>{{ $client->Nip }}</td>
        <td>{{ $client->red->descripcion }}</td>
        <td>{{ $client->FechaAlta }}</td>
        <td>{{ $client->Fecha_ultcompra }}</td>
        <td>{{ $client->status->descripcion }}</td>
        <td>
            {{--<a data-toggle="tooltip" title="Detalle" href="{{ url('clienteregistro/'.$client->Id_Afiliado) }}">--}}
                {{--<i class="glyphicon glyphicon-list-alt"></i>--}}
            {{--</a>--}}
            @include('partials.menu-list-clientes')

        </td>

    </tr>
@endforeach
