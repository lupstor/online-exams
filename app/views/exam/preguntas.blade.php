@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Preguntas de Examen</h3>

            {{Examen::find($idExamen)->titulo}}
        </br>
        </br>
        {{link_to('exam/preguntas/crear-pregunta/'.$idExamen,"Crear Pregunta");}}


        </br>
        </br>
        <div class="well">
            @if ($preguntas->count())
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo Respuesta</th>
                    <th>Pregunta</th>
                    <th>Punteo</th>
                    <th>Porcentaje</th>
                    <th>Penalizacion</th>
                    <th>Respuesta Correcta</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->id }}</td>
                    <td>{{ $pregunta->tipo_respuesta }}</td>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->punteo }}</td>
                    <td>{{ $pregunta->porcentaje }}</td>
                    <td>{{ $pregunta->penalizacion }}</td>
                    <td>{{ $pregunta->respuesta_correcta }}</td>

                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                No existen preguntas para examen
            @endif
        </div>
    </div>
</div>
@stop