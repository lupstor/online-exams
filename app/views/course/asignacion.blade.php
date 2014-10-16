@extends('layouts.master')
@section('content')

<h3>Asignar Curso</h3>
<div class="well">
            <h3>Asignacion de cursos</h3>           
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                        <th>Agregar curso</th>
                        <th>Estudiante</th>
                </tr>
                </thead>

                <tbody> 
                <tr>
                    <td>
                    <div class="form-group">
		                {{ Form::label('curso', 'Curso') }}
		                {{ Form::select('id_curso', $cursos, null , array('class' => 'form-control')) }}
		            </div>
                    </td>
                    <td><div class="form-group">
		                {{ Form::label('usuario', 'Usuario') }}
		                {{ Form::select('id_usuario', $usuarios, null , array('class' => 'form-control')) }}
		            </div></td>                    
                </tr>                
                </tbody>
            </table>


            {{ Form::submit('Asignar', array('class' => 'btn btn-primary')) }}
            
            {{ Form::close() }}

        </div>
@stop