@extends('layouts.master')
@section('content')

<script>
    $(document).ready(function() {
        $("#session_form").validate({
            rules: {
                usuario: "required",
                password: {
                    required: true,
                    minlength: 1
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<div class="row">
    <div class="col-md-6 col-lg-4">
        <h3>Inicio de Sesi&#243;n  </h3>
        <div class="well">
                    
            {{ Form::open(array('id' => 'session_form','url' => 'session')) }}

            <div class="form-group">
                {{ Form::label('usuario', 'Usuario') }}
                {{ Form::text('usuario', Input::old('usuario'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Contrase&#241;a') }}
                {{ Form::text('password', Input::old('password'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Iniciar', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
@stop