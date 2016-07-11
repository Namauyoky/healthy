@extends('master')

@section('htmlheader_title')
    Cliente
@endsection
@section('contentheader_title')
    Detalle Cliente
@endsection
@section('main-content')
    {{--<div class="container">--}}
        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                        <div class="col-md-2">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/dist/img/customer.png') }}" alt="User profile picture">
                                    <h3 class="profile-username text-center">{{ $cliente->nombre_completo }}</h3>
                                    <p class="text-muted text-center">Distribuidor</p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Fecha Registro</b> <a class="pull-right">{{ $cliente->FechaAlta  }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Status</b> <a class="pull-right">{{ $cliente->status->descripcion  }}</a>
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-primary btn-block"><b>CRM</b></a>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <div class="col-md-8">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Datos Generales</strong></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Número de Afiliado:</td>
                                            <td>{{ $cliente->Id_Afiliado }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nip:</td>
                                            <td>{{ $cliente->Nip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td>{{ $cliente->nombre_completo }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha de Nacimiento:</td>
                                            <td>{{ $cliente->Fecha_Nacimiento }}</td>
                                        </tr>
                                        <tr>
                                            <td>Genero:</td>
                                            <td>{{ $cliente->Genero }}</td>
                                        </tr>
                                        <tr>
                                            <td>Edo. Civil:</td>
                                            <td>{{ $cliente->EdoCivil }}</td>
                                        </tr>

                                        <tr>
                                            <td>Ocupación:</td>
                                            <td>{{ $cliente->Ocupacion }}</td>
                                        </tr>

                                        <tr>
                                            <td>Identificación:</td>
                                            <td>{{ $cliente->Identificacion }}</td>
                                        </tr>
                                        <tr>
                                            <td>RFC/SSN:</td>
                                            <td>{{ $cliente->RFC }}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div><!-- ./box-body -->
                            </div><!-- /.box -->
                        </div>

                        <div class="col-md-4 col-md-offset-2">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>Dirección</strong></h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-user-information">
                                            <tbody>

                                            <td>Ciudad:</td>
                                            <td>{{ $cliente->ciudad->Nombre_Ciudad }}</td>
                                            </tr>
                                            <tr>
                                            <td>Estado:</td>
                                            <td>{{ $cliente->estado->Nombre_Estado }}</td>
                                            </tr>
                                            <tr>
                                            <td>País:</td>
                                            <td>{{ $cliente->pais->Nombre_Pais }}</td>
                                            </tr>
                                            <tr>
                                            <td>Domicilio:</td>
                                            <td>{{ $cliente->Domicilio }}</td>
                                            </tr>
                                            <tr>
                                            <td>Colonia:</td>
                                            <td>{{ $cliente->Colonia }}</td>
                                            </tr>
                                            <tr>
                                            <td>Código Postal:</td>
                                            <td>{{ $cliente->CodigoPostal }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                        </div><!-- /.col -->

                        <div class="col-md-4">
                            <!-- USERS LIST -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Contacto</strong></h3>
                                    <div class="box-tools pull-right">
                                        {{--<span class="label label-danger">8 New Members</span>--}}
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Teléfono:</td>
                                            <td>{{ $cliente->Telefono }}</td>
                                        </tr>
                                        <tr>
                                            <td>Teléfono Celular:</td>
                                            <td>{{ $cliente->Tel_Celular }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><a href="mailto:{{ $cliente->Correo_Electronico }}">{{ $cliente->Correo_Electronico }}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!--/.box -->
                        </div><!-- /.col -->

                        <div class="col-md-8 col-md-offset-2">
                            <!-- USERS LIST -->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Situación Multinivel</strong></h3>
                                    <div class="box-tools pull-right">
                                        {{--<span class="label label-danger">8 New Members</span>--}}
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Patrocinador:</td>
                                            <td>{{ $cliente->Id_Cliente_Patrocinador.' ' .$cliente->patrocinador->nombre_completo  }}</td>
                                        </tr>
                                        <tr>
                                            <td>Red:</td>
                                            <td>{{ $cliente->red->descripcion }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha Última Compra</td>
                                            <td>{{ $cliente->Fecha_ultcompra }}</td>
                                        </tr>
                                        <tr>
                                            <td>Puntos</td>
                                            <td>{{ $cliente->Puntos }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!--/.box -->
                        </div><!-- /.col -->

            </div><!-- /.row -->
        </section><!-- /.content -->
       {{--</div><!--container  -->--}}
@endsection




