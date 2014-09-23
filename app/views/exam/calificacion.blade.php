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

            {{ Form::open(array('id' => 'calficar_form','url' => 'exam/calificar/'. $idEvaluacion))
            }}


            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                        <th>Numero de Pregunta</th>
                        <th>Respuesta</th>
                        <th>Punteo</th>
                </tr>
                </thead>

                <tbody>

                @foreach ($detalle as $pregunta)

                <tr>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->respuesta }}</td>
                    <td><input type="text" size="5"  name="{{$pregunta->pregunta}}" value="{{$pregunta->punteo}}"/>/100
                    </td>

                </tr>
                @endforeach

                </tbody>
            </table>


            {{ Form::submit('Calificar', array('class' => 'btn btn-primary')) }}

            <div class="pull-right">
            <h4>Nota: {{$nota}}/100</h4>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>
@stop