<script type="text/javascript">
    $(document).ready(function(){


        //alert("listo");

        /*      $('select').select2({

         allowClear: true,
         placeholder:{

         id:"",
         text:'Seleccione'
         }

         });*/

        var $tabla= $("#tblAfiliados");

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

        $('#buscar').on('click',function (e) {
            e.preventDefault();

            $.ajax({
                type: 'GET',
                url: 'buscacliente',
                data:{data: $('#patrocinador').val()},
                success: function (data) {
                    $tabla.each(function() {
                        displaying = $(this).css("display");
                        if(displaying == "block") {
                            $(this).fadeOut('fast',function() {
                                $(this).css("display","none");
                                $tabla.empty();
                            });
                        } else {
                            $(this).fadeIn('fast',function() {
                                $(this).css("display","block");

                                for(datos in data.clientes){
                                    $tabla.append(
                                            "<tr><td class='id'><a href='#'>"  + data.clientes[datos].Id_Afiliado  +
                                            "</a></td><td class='nombre'>" +  data.clientes[datos].nombre_completo +
                                            "</td></tr>"
                                           );
                                }
                            });
                        }
                    });
                    //$('#resultado').html(usuarios)
                }
            })
        });

        //Limpiar y ocultar tabla de busqueda cuando cambia el valor del input text del patrocinador
        $('#patrocinador').on('input',function (e) {
            if($tabla.css("display")=="block"){
                $tabla.css("display","none");
                $tabla.empty();
            }
        });

        //click en row de tabla patrocinadores y cargar el número en input patrocinador
        $("#tblAfiliados").on("click","tr",function(e) {

            var row= $(this).find('td:first').text();
            $("#patrocinador").val(row);

            if($("#tblAfiliados").css("display")=="block"){
                $("#tblAfiliados").css("display","none");
                $("#tblAfiliados").empty();
            }
        });

        });//fin ready function
</script>
