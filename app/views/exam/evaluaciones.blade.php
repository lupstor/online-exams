@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado De Evaluaciones</h3>

        <div class="well">
            @if ($evaluaciones->count())
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Examen</th>
                    <th>Punteo</th>
                    <th>Curso</th>

                </tr>
                </thead>

                <tbody>
                @foreach ($evaluaciones as $evaluacion)
                <tr>
                    <td>{{ $evaluacion->id }}</td>
                    <td>{{ $evaluacion->alumno()->first()->nombre }}</td>
                    <td>{{ $evaluacion->examen()->first()->titulo }}</td>
                    <td>{{ $evaluacion->punteo }}</td>
                    <td>{{ $evaluacion->examen()->first()->curso()->first()->nombre}}</td>
                    <td>{{ link_to_action('ExamController@calificacion', 'Calificar',  array("id_evaluacion=".$evaluacion->id), array('class' => 'btn btn-primary')) }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                No existen evaluaciones para mostrar
            @endif
        </div>
    </div>
</div>
@stop