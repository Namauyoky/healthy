{{--@foreach($redes as $key => $value)--}}
    {{--<tr>--}}
        {{--<td>{{ $key.$value['Afiliado'] }}</td>--}}
        {{--<td>{{ $key.$value['Patrocinador'] }}</td>--}}
        {{--<td>{{ $key.$value['Nombre'] }}</td>--}}
        {{--<td>--}}
            {{--<a data-toggle="tooltip" title="Detalle" href="{{ url('clienteregistro/'.$client->Id_Afiliado) }}">--}}
            {{--<i class="glyphicon glyphicon-list-alt"></i>--}}
            {{--</a>--}}
            {{----}}
        {{--</td>--}}
    {{--</tr>--}}
{{--@endforeach--}}

{{--<style type="text/css">--}}
    {{--<!----}}
    {{--td {--}}
        {{--white-space: pre;--}}
    {{--}--}}
    {{---->--}}
{{--</style>--}}



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
        <td><a href='/redmultinivel/{{ $red['Afiliado'] }}' class="btn btn-line">{{ $red['Afiliado'] }}</a></td>
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
        <td><a data-toggle="tooltip" title="Red Individual" href="{{ url('redmultinivel/'.$red['Afiliado']) }}" class="btn btn-line"> <i class="glyphicon glyphicon-refresh"></i></a></td>
    </tr>
@endforeach

