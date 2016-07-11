<style type="text/css">
    <!--
    td {
        white-space: pre;
    }

    tr {
        page-break-inside: avoid;
    }
    -->
</style>

@foreach($redes as $red)
    <tr>
        <td>{{ $red['Afiliado'] }}</td>
        {{--<td>--}}
        {{--<form  method="get" action="/datosclientemultinivel/{!! $red['Afiliado'] !!}">--}}
        {{--<button class="btn btn-adn">datos</button>--}}
        {{--</form>--}}
        {{--<td>--}}
        {{--<td height="50">{{ $red['Afiliado'] }}</td>--}}
        <td>{{ $red['Patrocinador'] }}</td>
        <td>{{ $red['Nombre'] }}</td>
        <td>{{ $red['Puntoscalificacion'] }}</td>
        <td>{{ $red['Puntosnegocio'] }}</td>
        <td>{{ $red['Puntoslealtad'] }}</td>
        </tr>
@endforeach