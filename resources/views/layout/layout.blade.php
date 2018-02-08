<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog System</title>

        <link rel = "stylesheet" href = "{{ asset('css/bootstrap/css/bootstrap(3.3.7).css') }}">
        <link rel = "stylesheet" href = "{{ asset('css/stylo.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <!-- java script files -->
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery-2.0.2.js') }}"></script>
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery.min.js') }}"></script>
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">
                    <a class="navbar-brand" href="" style="font-size: 25px;">
                        Blog System
                    </a>
                </div>
            </nav>

        @yield('content')

        </div>
    </body>
</html>
