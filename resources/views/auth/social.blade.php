<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    @if ($errors->has('msg'))
                        <div class="alert alert-warning">
                            {{ $errors->first('msg') }}
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading text-center">Social Login </div>

                        <div class="panel-body">
                            <p class="lead text-center">Authenticate using your social network account from one of following providers</p>
                            <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block">
                                Login with Facebook
                            </a><br><br>
                            <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-info btn-block">
                                Login with Twitter
                            </a><br><br>
                            <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
                                Login with Google
                            </a><br><br>
                            <a href="{{ route('social.oauth', 'github') }}" class="btn btn-default btn-block">
                                Login with Github
                            </a>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
