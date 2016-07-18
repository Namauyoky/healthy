<div class="text-left">
    <h3>Información General</h3>
</div>
<form class="form-horizontal">
    <div class="form-group">
        <label for="cliente" class="control-label col-xs-2">Afiliado</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="cliente" value="{{ $cliente->Id_Afiliado.' '.$cliente->nombre_completo}}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="status" class="control-label col-xs-2">Estado</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="status" value="{{ $cliente->status->descripcion }}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="alta" class="control-label col-xs-2">Fecha de Registro</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="alta" value="{{ $cliente->FechaAlta }}" readonly>
        </div>
    </div>
</form>