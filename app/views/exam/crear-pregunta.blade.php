@extends('layouts.master')
@section('content')

<h3>Crear Pregunta</h3>

{{Examen::find($idExamen)->titulo}}
</br>
</br>

<div class="row">
    <div class="col-md-7 col-lg-5">
        <div class="well">


            {{ Form::open(array('id' => 'session_form','url' => 'exam/preguntas/guardar-pregunta/'. $idExamen)) }}


            <div class="form-group">
                {{ Form::label('tipo_respuesta', 'Tipo De Respuesta') }}
                {{ Form::select('tipo_respuesta', array('fv' => 'Falso/Verdadero', 'sel_mul' => 'Seleccion
                Multiple','directa' => 'Respuesta abierta'),null , array('class' => 'form-control'));}}
            </div>

            <div class="form-group">
                {{ Form::label('pregunta', 'Pregunta') }}
                {{ Form::textarea('pregunta', Input::old('Pregunta'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('punteo', 'Punteo') }}
                {{ Form::text('punteo', Input::old('Punteo'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('porcentaje', 'Porcentaje') }}
                {{ Form::text('porcentaje', Input::old('Porcentaje'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('penalizacion', 'Penalizacion') }}
                {{ Form::text('penalizacion', Input::old('Penalizacion'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('respuesta_correcta', 'Respuesta Correcta') }}
                {{ Form::text('respuesta_correcta', Input::old('Respuesta Correcta'), array('class' => 'form-control')) }}
            </div>


            {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
@stop