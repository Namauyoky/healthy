<!DOCTYPE html>
<html lang="es">

@include('includes.htmlheader')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('includes.header')
    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('includes.contentheader')

        {{--<!-- Content Header (Page header) -->--}}
        {{--<section class="content-header">--}}
            {{--<h1>--}}
                {{--Dashboard--}}
                {{--<small>Version 2.0</small>--}}
            {{--</h1>--}}
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
                {{--<li class="active">Dashboard</li>--}}
            {{--</ol>--}}
        {{--</section>--}}

        <!-- Main content -->
        <section class="content">

            @yield('main-content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('includes.controlsidebar')
    @include('includes.footer')

</div><!-- ./wrapper -->

@include('includes.scripts')

</body>
</html>