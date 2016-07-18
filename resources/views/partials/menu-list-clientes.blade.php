<!-- Single button -->
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a data-toggle="tooltip" title="Información Completa del Cliente" href="{{ url('detalle-cliente/'.$client->Id_Afiliado) }}">
            <i class="glyphicon glyphicon-search"></i>Ver Detalle
            </a></li>
        <li><a data-toggle="tooltip" title="Modificar Información del Cliente" href="{{ route('edit-cliente',$client->Id_Afiliado) }}">
                <i class="glyphicon glyphicon-edit"></i>Editar
            </a></li>
        <li><a data-toggle="tooltip" title="Estretegia de Negocio" href="{{ url('crm/'.$client->Id_Afiliado) }}">
                <i class="glyphicon glyphicon-certificate"></i>CRM
            </a></li>
        <li><a data-toggle="tooltip" title="Descendencia Multinivel" href="{{ url('redmultinivel/'.$client->Id_Afiliado) }}">
                <i class="glyphicon glyphicon-list-alt"></i>Red
            </a></li>
        <li role="separator" class="divider"></li>
        <li><a data-toggle="tooltip" title="Cambios de Redes" href="{{ url('clienteregistro/'.$client->Id_Afiliado) }}">
                <i class="glyphicon glyphicon-cog"></i>Movimientos
            </a></li>
    </ul>
</div>