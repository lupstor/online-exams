/**
 * Created by herber on 9/22/14.
 */

$(document).ready(function () {
    $( "#tipo_respuesta" ).change(function() {
       var tipo_respuesta = $('#tipo_respuesta').val();

        if(tipo_respuesta == "fv"){

            $("#respuesta_fv").show();
            $("#respuestas_sel_mul").hide();

           $( "#respuesta_correcta").show();
       }else if(tipo_respuesta =='sel_mul'){
            $( "#respuestas_sel_mul").show();
            $( "#respuesta_fv").hide();

           $( "#respuesta_correcta").show();
       }else{
           $( "#respuesta_correcta").hide();
       }

    }).trigger("change");



});