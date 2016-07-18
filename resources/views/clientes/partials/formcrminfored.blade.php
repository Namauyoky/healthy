<div class="text-left">
    <h3>Información de la Red</h3>
</div>
<form class="form-horizontal">
    <div class="form-group">
        <label for="patrocinador" class="control-label col-xs-2">Patrocinador</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="patrocinador" value="{{ $cliente->patrocinador->Id_Afiliado.' '.$cliente->patrocinador->nombre_completo}}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="totalred" class="control-label col-xs-2">Puntos Lealtad</label>
        <div class="col-xs-3">
            <input type="number" class="form-control" id="totalred" value="{{ $cliente->Puntos }}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="alta" class="control-label col-xs-2">Fecha de Última Compra</label>
        <div class="col-xs-3">
               {{--<span class="label label-info">--}}
                   <a href="{{ url('detallepedido/'.$cliente->Pedido_ultcompra) }}" class="text-info">{{ $cliente->Fecha_ultcompra.' '.'(# '.$cliente->Pedido_ultcompra.')' }}  </a>


                       {{--<input type="text" class="form-control" id="alta" value="{{ $cliente->Fecha_ultcompra.' '.'(# '.$cliente->Pedido_ultcompra.')' }}" readonly></a>--}}
        </div>
    </div>
</form>
