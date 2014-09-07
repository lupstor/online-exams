@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3>Listado De Examenes</h3>

        <div class="well">
            @if ($examenes->count())
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Duracion</th>
                    <th>Hora Inicio</th>
                    <th>Hora fin</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($examenes as $examen)
                <tr>
                    <td>{{ $examen->id }}</td>
                    <td>{{ $examen->titulo }}</td>
                    <td>{{ $examen->duracion }}</td>
                    <td>{{ $examen->hora_inicio }}</td>
                    <td>{{ $examen->hora_fin }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                No existen examenes para mostrar
            @endif
        </div>
    </div>
</div>
@stop