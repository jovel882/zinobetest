<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title','Test')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */ 
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }
            
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {height: 450px}
            
            /* Set gray background color and 100% height */
            .sidenav {
                padding-top: 20px;
                background-color: #f1f1f1;
                height: 100%;
            }
            
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }
            
            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;} 
            }
            .panel{
                margin: 2em 0;
            }
            #email{
                color: white;
                font-weight: bold;
            }
        </style>
        @yield('css')
        @stack('css')
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span> Test</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        @if(!empty(Session\Session::instance()->get('user')))
                            <li><a href="/user"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
                            <li><a href="/country"><span class="glyphicon glyphicon-globe"></span> Países</a></li>
                        @else
                            <li><a href="/sign-up"><span class="glyphicon glyphicon-lock"></span> Registro</a></li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(empty(Session\Session::instance()->get('user')))
                            <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Ingresar</a></li>
                        @else
                            @isset($user)
                                <li><p class="navbar-text">Hola, {{$user->name??" "}}</p></li>
                            @endisset
                            <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                        @endif                        
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container-fluid text-center">    
            <div class="row content">
                <div class="col-sm-12 text-left"> 
                    @yield('content')                    
                </div>
            </div>
        </div>
        <footer class="container-fluid text-center">
            <p><a href="mailto:jovel882@gmail.com" id="email">John Fredy Velasco Bareño</a></p>
        </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        @yield('js')
        @stack('js')
    </body>
    </html>
    