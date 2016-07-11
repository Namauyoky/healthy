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
        Red Multinivel
    </h1>
</section>
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i>Healthy People Co.
                <small class="pull-right">Generó: {{ $cliente->user->name }}<br>{{ $date}}</small>
            </h2>
        </div><!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-3">
            <!-- About Me Box -->
            {{--<div class="box box-primary">--}}
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{ $cliente->Id_Afiliado.' '.$cliente->nombre_completo }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class=" col-md-9 col-lg-9 ">
                        <td class="text-info">Red Multinivel Periodo: {{  $titleperiodo   }} </td>
                        <table class="table">
                            @include('clientes.partials.head-red')
                            <tbody>
                            @include('clientes.partials.list-redpdf')
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <h5 class="box-title">{{ $cliente->nombre_completo }}
                        {{--<a  data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                        <span class="pull-right">
                            <a href="{{ URL::previous() }}"  data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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