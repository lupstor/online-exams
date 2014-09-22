@extends('layouts.master')
@section('content')

<script>
    $(document).ready(function() {
        $("#create_exam_form").validate({
            rules: {
                id_curso: "required",
                titulo: "required",
                n_intentos: "required",
                duracion: "required",
                hora_inicio: "required",
                hora_fin: "required",
                pregunta: "required"

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<div class="row">
    <div class="col-md-7 col-lg-5">
        <h3>Crear Examen </h3>
        <div class="well">

            {{ Form::open(array('id' => 'create_exam_form','url' => 'exam')) }}

            <div class="form-group">
                {{ Form::label('curso', 'Curso') }}
                {{ Form::select('id_curso', $cursos,null , array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('titulo', 'Titulo') }}
                {{ Form::text('titulo', Input::old('Titulo'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('n_intentos', 'No. intentos') }}
                {{ Form::text('n_intentos', Input::old('No. intentos'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('duracion', 'Duracion (min)') }}
                {{ Form::text('duracion', Input::old('Duracion'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('hora_inicio', 'Hora Inicio (hh:mm)') }}
                {{ Form::text('hora_inicio', Input::old('Hora Inicio (hh:mm)'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('hora_fin', 'Hora Fin (hh:mm)') }}
                {{ Form::text('hora_fin', Input::old('Hora Fin (hh:mm)'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('pregunta', 'Clave') }}
                {{ Form::text('pregunta', Input::old('Clave'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
@stop