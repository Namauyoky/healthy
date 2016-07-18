<?php

namespace healthy\Models;

use Illuminate\Database\Eloquent\Model;

class PedidosClientes extends Model
{
    //
    protected $table='pedidosclientes';
    
    //Campos para asignación masiva, es decir que pueden ser enviados por medio del formulario
    protected $fillable=[
        'Id_Clientes_Afiliado',
        'Id_Almacenes_Almacen',
        'Id_SalidasAlmacen_Salida',
        'Consecutivo_Pedido',
        'Fecha_Pedido',
        'Hora_Pedido',
        'Id_Usuarios_Vendedor',
        'Sub_Total',
        'Iva',
        'Total',
        'Totalptosnegocio',
        'Totalptoshealthy',
        'Totalptoscalificacion',
        'Id_TipoEntrega_Entrega',
        'Id_DocumentosImpresos_DocImpreso',
        'AcumCorte',
        'Status',
        'TotalEfectivo',
        'TotalTarjeta',
        'TotalDeposito',
        'sujeto_impuesto',
        'nota',
        'Id_ListaPrecios',
        'Id_Periodo',

    ];
    protected $primaryKey='Id_PedidoCliente';
    public $timestamps = false;
    
    
    public function clientepedido(){
        
        return $this->belongsTo('healthy\Models\Clientes','Id_Clientes_Afiliado');
        
    }
    
}
