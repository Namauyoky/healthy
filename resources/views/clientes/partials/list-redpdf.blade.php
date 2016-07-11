
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
        <td>{{ $red['Patrocinador'] }}</td>
        <td>{{ $red['Nombre'] }}</td>
    </tr>
@endforeach