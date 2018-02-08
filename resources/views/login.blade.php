@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row form-group">
            <div class="col-sm-4">
                @if ($errors->has('msg'))
                    <div class="alert alert-warning">
                        {{ $errors->first('msg') }}
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                @endif
                <a href="{{ route('social.oauth', 'google') }}">
                    <center><img src="{{ asset('img/google-login-button.png') }}" style="width: 75%;"></center>
                </a><br><br>
                @if(Session::has('message'))
                    <div class="form-group"><center>
                        <div class="alert alert-info" style="width: 75%;"><a href="author_panel.php" class="close" data-dismiss="alert">&times;</a><strong>{{ Session::get('message') }}</strong></div>
                    </center></div>
                @endif
            </div>
            <div class="col-sm-8" style="border-left: thick double #002259; height: 500px;">
                <h2>Latest Articles</h2>
                <!-- show publlish blog list here-->
                @foreach($blogs as $blog)
                    @if(isset($blog))
                        <li style="font-size: 25px; margin-left: 20px;">
                            <a href="openblog/{{ $blog->id }}">
                                {{ $blog->blog_title }}
                            </a>
                        </li>
                    @else
                        <span>You have no blogs yet</span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection