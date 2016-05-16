<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src=" {{ asset('/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <li class="active">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Inicio</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>Administración</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i>Manejo de Cajas<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Habilitar Cajas</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Cierre de Día</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Configuraciones<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Parámteros</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>ISR</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>Catálogo</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i>Usuarios<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('registro') }}"><i class="fa fa-long-arrow-right"></i>Nuevo</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Modificar/Eliminar</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Asignar a Almacén</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Log</a></li>

                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Clientes<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="{{ route('altacliente') }}"><i class="fa fa-long-arrow-right"></i>Nuevo</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Consulta</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Modificar</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Movimientos</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>CRM</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Productos<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="{{ url('productos/create') }}"><i class="fa fa-long-arrow-right"></i>Nuevo</a></li>
                            <li><a href="{{ url('productos') }}"><i class="fa fa-long-arrow-right"></i>Modificar</a></li>

                            <li><a href="#"><i class="fa fa-arrow-circle-o-right"></i>Lista de Precios<i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('productos/create') }}"><i class="fa fa-long-arrow-right"></i>Crear</a></li>
                                <li><a href="#"><i class="fa fa-long-arrow-right"></i>Editar</a></li>
                                <li><a href="#"><i class="fa fa-long-arrow-right"></i>Asignar</a></li>
                            </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Almacenes<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Nuevo</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Modificar/Eliminar</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Niveles<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Nuevo</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Modificar</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


            {{--<li>--}}
                {{--<a href="pages/widgets.html">--}}
                    {{--<i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Ventas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                        <ul class="treeview-menu">
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Pedidos<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-arrow-circle-o-right"></i>Generar<i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i>CeDis</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i>Almacén</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i>Web</a></li>
                                </ul>

                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Detalle de Pedido</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Generar Orden Envío</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Rastreo Orden Envío</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i>Puntos<i class="fa fa-angle-left pull-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Canje</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Detalle</a></li>
                        </ul>
                    </li>
                </ul>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-industry"></i>
                    <span>Almacén</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><a href=""><i class="fa fa-circle-o"></i>Movimientos<i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-long-arrow-right"></i>Entradas</a></li>
                        <li><a href="#"><i class="fa fa-long-arrow-right"></i>Salidas</a></li>
                        <li><a href="#"><i class="fa fa-long-arrow-right"></i>Traspasos</a></li>
                    </ul>
                    </li>
                    <li><a href=""><i class="fa fa-circle-o"></i>Auditoría<i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Existencias</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Inventario</a></li>
                            <li><a href="#"><i class="fa fa-long-arrow-right"></i>Maestro Inventario</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>Maestro de Cierre</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Edo. de Cuenta</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Comisiones</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Proceso de Cierre</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-line-chart"></i> <span>Reportes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Generar Reporte</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Crear Reporte</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>