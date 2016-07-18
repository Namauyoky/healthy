@foreach($pedidos as $pedido)
    <tr>
        <td class="text-right">{{ $pedido->Id_PedidoCliente }}</td>
        <td>{{ $pedido->Almacen }}</td>
        <td>{{ $pedido->TipoPedido }}</td>
        <td class="text-right">{{ $pedido->Consecutivo_Pedido  }}</td>
        <td>{{ $pedido->Fecha_Pedido }}</td>
        <td>{{ $pedido->Hora_Pedido }}</td>
        <td class="currency">{{ $pedido->Sub_Total }}</td>
        <td class="text-right">{{ $pedido->Iva }}</td>
        <td class="text-right">{{ $pedido->Total }}</td>
        <td class="text-right">{{ $pedido->Totalptoscalificacion }}</td>
        <td class="text-right">{{ $pedido->Totalptosnegocio }}</td>
        <td class="text-right">{{ $pedido->Totalptoshealthy }}</td>
        <td>{{ $pedido->Status }}</td>
        <td class="text-right">{{ $pedido->TotalEfectivo }}</td>
        <td class="text-right">{{ $pedido->TotalTarjeta }}</td>
        <td class="text-right">{{ $pedido->TotalDeposito }}</td>
        <td>{{ $pedido->ListaPrecios }}</td>
        <td>{{ $pedido->periodo }}</td>

    </tr>
@endforeach