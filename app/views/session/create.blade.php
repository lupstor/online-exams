@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-6 col-lg-4">
        <h3>Inicio de Sesi&#243;n  </h3>
        <div class="well">
            <form action="store" method="post">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="email" class="form-control" id="usuario" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <label for="password">Contrase&#241;a</label>
                    <input type="password" class="form-control" id="password" placeholder="Contrase&#241;a">
                </div>
                <button type="submit" class="btn btn-primary">Iniciar</button>
            </form>
        </div>
    </div>
</div>

@stop