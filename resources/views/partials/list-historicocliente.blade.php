
@foreach($historicperiods as $period)
    <tr>
        <td>{{ $period['Periodo'] }}</td>
        <td class="text-right">{{ $period['CalificacionPersonal'] }}</td>
        <td class="text-right">{{ $period['Comisiones'] }}</td>
        <td class="text-right">{{ $period['ComprasRed']  }}</td>
        <td class="text-right">{{ $period['AfiliadosRed'] }}</td>
        <td>{{ $period['Rango'] }}</td>
        <td>{{ $period['PrimerNivel'] }}</td>
        <td>{{ $period['SegundoNivel'] }}</td>
        <td class="text-right">{{ $period['PuntosCompra'] }}</td>
        <td class="text-right">{{ $period['PuntosRango'] }}</td>

    </tr>
@endforeach