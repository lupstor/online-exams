@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4">
        <h3>Subir Examen</h3>
        <div class="well">
            {{ Form::open(array('id' => 'upload_exam_form','url' => 'exam/upload-exam', 'files'=>true)) }}
            <div class="form-group">
                {{ Form::label('file','Seleccionar Examen',array('id'=>'','class'=>'')) }}
                {{ Form::file('file','',array('id'=>'','class'=>'')) }}
            </div>
            {{ Form::submit('Subir', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
