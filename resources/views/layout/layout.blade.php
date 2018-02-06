<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel = "stylesheet" href = "{{ asset('css/bootstrap/css/bootstrap(3.3.7).css') }}">
        <link rel = "stylesheet" href = "{{ asset('css/stylo.css') }}">
        
        <!-- java script files -->
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery-2.0.2.js') }}"></script>
        <script language = "javascript" type = "text/javascript" src = "{{ asset('js/jquery.min.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        @yield('content')
    </body>
</html>
