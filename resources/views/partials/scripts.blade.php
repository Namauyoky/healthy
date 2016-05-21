{{--<!-- jQuery 2.1.4 -->--}}
{{--<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>--}}
{{--<!-- Bootstrap 3.3.5 -->--}}
{{--<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>--}}
{{--<!-- FastClick -->--}}
{{--<script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>--}}
{{--<!-- AdminLTE App -->--}}
{{--<script src="{{ asset('dist/js/app.min.js') }}"></script>--}}
{{--<!-- Sparkline -->--}}
{{--<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>--}}
{{--<!-- jvectormap -->--}}
{{--<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
{{--<!-- SlimScroll 1.3.0 -->--}}
{{--<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>--}}
{{--<!-- ChartJS 1.0.1 -->--}}
{{--<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>--}}
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="{{ asset('dist/js/demo.js') }}"></script>--}}

{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>--}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

        alert("listo");




  /*      $('select').select2({

            allowClear: true,
            placeholder:{

                id:"",
                text:'Seleccione'
            }

        });*/

        $.fn.populateSelect= function (values) {

            var options='';

            $.each(values,function (key,row) {
                options+= '<option value="' + row.value +  '"> ' + row.text +  '</option>';
            });
            //this representa el objeto select
            $(this).html(options);
        }

        $('#pais_id').change(function () {
             $('#ciudad_id').empty().change();
             $('#estado_id').empty().change();

            //Esto seria aigual a var pais_id= $pais_id.val()
            var pais_id= $(this).val();

            if(pais_id==''){
                $('#estado_id').empty().change();
            }else{

                $.getJSON('/paisestados/'+pais_id,null,function (values) {
                   $('#estado_id').populateSelect(values);

                });
            }
        })


        $('#estado_id').change(function () {

            //Esto seria aigual a var estado_id= $estado_id.val()
            var estado_id= $(this).val();

            if(estado_id==''){
                $('#ciudad_id').empty().change();
            }else{

                $.getJSON('/ciudades/'+estado_id,null,function (values) {
                    $('#ciudad_id').populateSelect(values);

                });

            }
        })

    });

</script>





    {{--//Para que la pagina se recargue y muestre las opciones--}}
{{--//      $('#search select').change(function(){--}}
{{--//--}}
{{--//            $('#search').submit();--}}
{{--//--}}
{{--//        });--}}
    {{----}}
    {{--//--}}



