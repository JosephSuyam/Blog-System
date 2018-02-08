<!doctype html>
<html lang="{{ app()->getLocale() }}" style="background-color: #e5efff">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog System</title>

        <link rel = "stylesheet" href = "{{ asset('css/bootstrap/css/bootstrap(3.3.7).css') }}">
        <link rel = "stylesheet" href = "{{ asset('css/stylo.css') }}">
        
        <!-- java script files -->
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery-2.0.2.js') }}"></script>
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery.min.js') }}"></script>
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/bootstrap.js') }}"></script>
        <!-- Angularjs -->
        <script src="{{ asset('js/angular.min.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top" style="margin-right: 15px; margin-left: 15px;">
            <div style="display: inline-block;">
                <a class="navbar-brand" href="" style="font-size: 25px;">
                    Blog System
                </a>
            </div>
            <div style="float: right; margin-top: 10px;">
                @if(Auth::check())
                    <a href="/newblogsystem/public/users/logout"><button class="btn btn-outline-danger">Logout</button></a>
                @endif
            </div>
        </nav>

        @yield('content')

    </body>
</html>
