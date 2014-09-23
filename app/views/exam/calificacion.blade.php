@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10 col-lg-8">
        <div class="well">
            <h3>Calificacion De Evaluacion - {{ $idEvaluacion }} -</h3>
            <center><h4>
                    @foreach ($evalu as $evaluacion)
                    @if ($idEvaluacion == $evaluacion->id)
                    {{ $evaluacion->alumno()->first()->nombre }} - {{ $evaluacion->examen()->first()->titulo }} - {{
                    $evaluacion->examen()->first()->curso()->first()->nombre }}
                    @endif
                    @endforeach
                </h4></center>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <center>
                        <th>Numero de Pregunta</th>
                    </center>
                    <center>
                        <th>Respuesta</th>
                    </center>
                    <center>
                        <th>Punteo</th>
                    </center>
                </tr>
                </thead>

                <tbody>

                @foreach ($detalle as $pregunta)

                <tr>
                    <center>
                        <td>{{ $pregunta->pregunta }}</td>
                    </center>
                    <center>
                        <td>{{ $pregunta->respuesta }}</td>
                    </center>
                    <center>
                        <td><input type="text" size="5" name="punteo"
                                  />/100
                        </td>
                    </center>
                    <center>
                        <td>{{ link_to_action('ExamController@calificacion', 'Registrar
                            nota',array("id_evaluacion=".$evaluacion->id."&id_pregunta=".$evaluacion->detalle()->first()->pregunta."&id_pregunta=".$evaluacion->detalle()->first()->punteo
                            ), array('class' => 'btn btn-primary')) }}
                    </center>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@stop