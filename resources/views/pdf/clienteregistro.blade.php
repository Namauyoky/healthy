<!DOCTYPE html>
<html lang="en">

@include('partials.htmlheader')

<body>

    {{--<div class="pad margin no-print">--}}
        {{--<div class="callout callout-info" style="margin-bottom: 0!important;">--}}
            {{--<h4><i class="fa fa-info"></i> Nota:</h4>--}}
            {{--This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.--}}
        {{--</div>--}}
    {{--</div>--}}
    <section class="content-header">
        <h1>
            Registro Distribuidor
            <small>#{{ $datoscliente->Id_Afiliado }}</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>Healthy People Co.
                    <small class="pull-right">{{ $datoscliente->red->descripcion  }}<br>Registró: {{ $datoscliente->user->name }}</small>
                </h2>
            </div><!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
                {{--<A href="" >Edit Profile</A>--}}

                {{--<A href="" >Logout</A>--}}
                {{--<br>--}}
                <p class=" text-info">{{ $date }} </p>
            </div>

        </div>

            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    {{--<div class="box box-primary">--}}
                        <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $datoscliente->nombre_completo }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>

                                    <td class="text-info">Datos Generales</td>
                                    <tr>
                                        <td>Número de Afiliado:</td>
                                        <td>{{ $datoscliente->Id_Afiliado }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nip:</td>
                                        <td>{{ $datoscliente->Nip }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>{{ $datoscliente->nombre_completo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Nacimiento:</td>
                                        <td>{{ $datoscliente->Fecha_Nacimiento }}</td>
                                    </tr>
                                    <tr>
                                        <td>Genero:</td>
                                        <td>{{ $datoscliente->Genero }}</td>
                                    </tr>
                                    <tr>
                                        <td>Edo. Civil:</td>
                                        <td>{{ $datoscliente->EdoCivil }}</td>
                                    </tr>

                                    <tr>
                                        <td>Ocupación:</td>
                                        <td>{{ $datoscliente->Ocupacion }}</td>
                                    </tr>

                                    <tr>
                                        <td>Identificación:</td>
                                        <td>{{ $datoscliente->Identificacion }}</td>
                                    </tr>
                                    <tr>
                                        <td>RFC/SSN:</td>
                                        <td>{{ $datoscliente->RFC }}</td>
                                    </tr>
                                    <td class="text-info">Ubicación</td>
                                    <tr>
                                        <td>Ciudad:</td>
                                        <td>{{ $datoscliente->ciudad->Nombre_Ciudad }}</td>
                                    </tr>
                                    <tr>
                                        <td>Estado:</td>
                                        <td>{{ $datoscliente->estado->Nombre_Estado }}</td>
                                    </tr>
                                    <tr>
                                        <td>País:</td>
                                        <td>{{ $datoscliente->pais->Nombre_Pais }}</td>
                                    </tr>
                                    <tr>
                                        <td>Domicilio:</td>
                                        <td>{{ $datoscliente->Domicilio }}</td>
                                    </tr>
                                    <tr>
                                        <td>Colonia:</td>
                                        <td>{{ $datoscliente->Colonia }}</td>
                                    </tr>
                                    <tr>
                                        <td>Código Postal:</td>
                                        <td>{{ $datoscliente->CodigoPostal }}</td>
                                    </tr>
                                    <td class="text-info">Contacto</td>
                                    <tr>
                                        <td>Teléfono:</td>
                                        <td>{{ $datoscliente->Telefono }}</td>
                                    </tr>
                                    <tr>
                                        <td>Teléfono Celular:</td>
                                        <td>{{ $datoscliente->Tel_Celular }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><a href="mailto:{{ $datoscliente->Correo_Electronico }}">{{ $datoscliente->Correo_Electronico }}</a></td>
                                    </tr>
                                    <td class="text-info">Referencia</td>
                                    <tr>
                                        <td>Patrocinador:</td>
                                        <td>{{ $datoscliente->Id_Cliente_Patrocinador.' '. $datoscliente->patrocinador->nombre_completo }}  </td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Registro:</td>
                                        <td>{{ $datoscliente->FechaAlta }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <h5 class="box-title">{{ $datoscliente->nombre_completo }}
                            {{--<a  data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                            <span class="pull-right">
                            <a href="{{ url('alta-cliente') }}"  data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </span>
                            </h5>

                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        <!-- this row will not appear when printing -->
    </section><!-- /.content -->
    <div class="clearfix"></div>
{{--</div><!-- /.content-wrapper -->--}}

</body>
</html>