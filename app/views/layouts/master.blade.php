<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <!--Jquery 1.11 -->
        {{ HTML::script('js/jquery/jquery-1.11.1.min.js') }}

        <!--Bootstrap 3 -->
        {{ HTML::style('css/bootstrap/css/bootstrap.css') }}
        {{ HTML::script('css/bootstrap/js/bootstrap.js') }}

        <!--Validataion -->
        {{ HTML::script('js/jquery/plugins/validation/jquery.validate.js') }}
        {{ HTML::script('js/jquery/plugins/validation/additional-methods.js') }}
        {{ HTML::script('js/jquery/plugins/validation/localization/messages_es.js') }}
    </head>
    <body>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <!--Barra de navegacion-->
                <?php echo View::make('nav-bar') ?>
                
                <!--Mensages genericos flash de error o mensaje-->
                @if (Session::has('error') || Session::has('message'))
                <div class="alert {{Session::has('error') ?'alert-danger' : 'alert-success' }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{Session::has('error') ? Session::get('error') : Session::get('message' ); }}
                </div>
                @endif
                
                <!--Contenido-->  
                <div>
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

