<!DOCTYPE html>
<html lang="es">

@include('partials.htmlheader')

<body class="skin-red-light sidebar-mini">
<div class="wrapper">

    @include('partials.header')
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('partials.contentheader')

        {{--Si no queremos usar el packete laracasts/flash, descomentamos éste --}}
        @include('partials.flash')
                {{-- @include('flash::message') --}}

        <!-- Main content -->
        <section class="content">

            @yield('main-content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('partials.controlsidebar')
    @include('partials.footer')

</div><!-- ./wrapper -->
@include('partials.jqueryscript')
@yield('scripts')
{{--Desaparecer el div de flash alert cuando el msj no es importante --}}
<script>
    //Para que se muestre Alert Modal
//    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(10000).slideUp(300);
</script>
@include('partials.scripts')
</body>

</html>