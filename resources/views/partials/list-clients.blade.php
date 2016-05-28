@foreach($lastclients as $client)
    <tr>
        <td>{{ $client->Id_Afiliado }}</td>
        <td>{{ $client->nombre_completo }}</td>
        <td>{{ $client->Id_Cliente_Patrocinador }}</td>
        <td>{{ $client->Nip }}</td>
        {{--<td>--}}
        {{--{!! Form::open(['route' => ['delete', $user->id], 'method' => 'delete']) !!}--}}
        {{--<button type="button" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"--}}
        {{--data-userid="{{ $user->id }}"--}}
        {{--data-username="{{ $user->name }}"--}}
        {{--data-product_destroy_route="{{ route('delete', $user->id) }}">--}}
        {{--<i class="fa fa-trash"></i>--}}
        {{--</button>--}}


        {{--{!! Form::close() !!}--}}
        {{--</td>--}}
    </tr>
@endforeach