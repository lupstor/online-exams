@extends('layouts.master')
@section('content')
<?php
$textoPreguntas = "";

function preguntaFV($textPregunta, $numeroPregunta) {
    $textoArmado = '<div class="panel panel-primary">';
    $textoArmado = $textoArmado . '<div class="well well-sm">';
    $textoArmado = $textoArmado . '<b><h3>' . $textPregunta . '</h3></b>';
    $textoArmado = $textoArmado . '<select class="form-control" form="resp" name="preg' . $numeroPregunta . '" id="preg' . $numeroPregunta . '"  >';
    $textoArmado = $textoArmado . '<option>Verdadero</option>';
    $textoArmado = $textoArmado . '<option>Falso</option>';
    $textoArmado = $textoArmado . '</select>';
    $textoArmado = $textoArmado . '</div><!-- /input-group -->';
    $textoArmado = $textoArmado . '</div><br />';

    return $textoArmado;
}

function preguntaSeleccionMult($textPregunta, $listaRespuestas, $numeroPregunta) {

    $textoArmado = '<div class="panel panel-primary">';
    $textoArmado = $textoArmado . '<div class="well well-sm">';
    $textoArmado = $textoArmado . '<b><h3>' . $textPregunta . '</h3></b>';
    $textoArmado = $textoArmado . '<select class="form-control" form="resp" name="preg' . $numeroPregunta . '" id="preg' . $numeroPregunta . '"  >';
    foreach ($listaRespuestas as $valor) {
        $textoArmado = $textoArmado . '<option>' . $valor->respuesta . '</option>';
    }
    $textoArmado = $textoArmado . '</select>';
    $textoArmado = $textoArmado . '</div><!-- /input-group -->';
    $textoArmado = $textoArmado . '</div><br />';

    return $textoArmado;
}

function preguntaDirecta($textPregunta, $numeroPregunta) {
    $textoArmado = '<div class="panel panel-danger">';
    $textoArmado = $textoArmado . '<div class="well well-sm">';
    $textoArmado = $textoArmado . '<b><h3>' . $textPregunta . '</h3></b>';
    $textoArmado = $textoArmado . '<input type="text" class="form-control" name="preg' . $numeroPregunta . '" id="preg">';
    $textoArmado = $textoArmado . '</div><!-- /input-group -->';
    $textoArmado = $textoArmado . '</div><br />';

    return $textoArmado;
}
?>
<script>
    function counter(field, time) {

        // access to html element
        var counter_field = document.getElementById(field);

        // destination date/time
        var date_stop = time; //new Date(2013,6,7,0,0,0,0);

        // call counting function every second (1000 ms)
        var counting_loop = setInterval(counting, 1000);

        // counting function
        function counting()
        {
            // current date/time
            var date_now = new Date();

            // text 
            var text = "THE END";

            if (date_stop == null) {
                var text = "- you forget date/time -";
            } else {

                // convert miliseconds to seconds
                var diff = Math.round((date_stop - date_now) / 1000);

                // still in future
                if ((0 < diff))
                {
                    // convert diff to days, hours, minutes, seconds

                    // seconds
                    var seconds = diff % 60;
                    diff = (diff - seconds) / 60;
                    if (seconds < 10)
                        seconds = "0" + seconds;

                    // minutes
                    var minutes = diff % 60;
                    diff = (diff - minutes) / 60;
                    if (minutes < 10)
                        minutes = "0" + minutes;

                    // hours
                    var hours = diff % 24;
                    diff = (diff - hours) / 24;
                    if (hours < 10)
                        hours = "0" + hours;

                    // days
                    var days = diff;
                    if (days < 10)
                        days = "0" + days;

                    // convert to text
                    text = " <b>days</b> " + days + " <b>hours</b> " + hours + ":" + minutes + ":" + seconds;
                } else {
                    // removing counter
                    counter_field.parentElement.removeChild(counter_field);
                    // 
                    // here put code to remove element from view
                    // 
                    unsetInterval(counting_loop);
                }
            }

            // put text into html
            counter_field.innerHTML = text;
        }
    }

    window.onload = function()
    {
        counter("field_1", new Date(2014, 5, 27, 16, 0, 0, 0));
        counter("field_2", new Date(2014, 6, 27, 21, 0, 0, 0));
    };
</script>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado De Preguntas</h3>
        <h2>{{$exampreguntas->titulo}}</h2>
        <div class="well">
            @if($varexamen->count())
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>ID-Examen</th>
                        <th>TipoRespuesta</th>
                        <th>Posibles respuestas</th>
                        <th>Respuesta Correcta</th>
                        <th>Pregunta</th>
                        <th>Punteo</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($varexamen as $pregunta)
                    <tr>
                        <td>{{ $pregunta->id }}</td>
                        <td>{{ $exampreguntas->first()->curso()->first()->nombre }}</td>
                        <td>{{ $pregunta->tipo_respuesta }}</td>
                        <td> 
                            <?php
                            $apreguntas = $pregunta->respuestas;
                            if ($apreguntas == null) {
                                $apreguntas = array();
                            }
                            if ($pregunta->tipo_respuesta == 'sel_mul') {
//                                echo "LO LLAMO !!!";
//                                $arrayques= $apreguntas->toarray();
                                $textoPreguntas = $textoPreguntas . preguntaSeleccionMult($pregunta->pregunta, $apreguntas, $pregunta->id);
                            }
                            if ($pregunta->tipo_respuesta == 'fv') {
                                $textoPreguntas = $textoPreguntas . preguntaFV($pregunta->pregunta, $pregunta->id);
                            }
                            ?>
                            @foreach($apreguntas as $pres)
                            {{$pres->respuesta}}
                            @endforeach
                        </td>
                        <td>{{ $pregunta->respuesta_correcta }}</td>
                        <td>{{ $pregunta->pregunta}}</td>
                        <td>{{ $pregunta->punteo}}</td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            No existen preguntas para mostrar
            @endif

        </div>
        <div class="col-md-12 col-lg-12">   
            <center><h1>*****{{$exampreguntas->titulo}}*****</h1></center>
            <div class="well" align='center'>

<?php echo "$textoPreguntas"; ?> 
                {{ link_to_action('ExamController@calificacion', 'Enviar a Calificar',  array($exampreguntas->id), array('class' => 'btn btn-primary')) }}
            </div>

        </div>



    </div>
</div>
@stop
