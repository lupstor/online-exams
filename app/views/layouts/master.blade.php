<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <!--Jquery 1.11 -->
        {{ HTML::script('js/jquery/jquery-1.11.1.min.js') }}
        <!--Bootstrap 3 -->
        {{ HTML::style('css/bootstrap/css/bootstrap.css') }}
        {{ HTML::script('css/bootstrap/js/bootstrap.js') }}
    </head>
    <body>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <?php echo View::make('nav-bar') ?>
                <div>
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

