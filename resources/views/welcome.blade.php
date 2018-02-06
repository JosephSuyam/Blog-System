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
                <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
                    Login with Google
                </a>
            </div>
            <div class="col-sm-8" style="border-left: thick double #002259; height: 500px;">
                <h2>Latest Articles</h2>
                <!-- show publlish blog list here-->
                @foreach($blogs as $blog)
                    @if(isset($blog))
                        <li style="font-size: 25px; margin-left: 20px;">
                            <a href="openblog/{{ $blog->blog_id }}">
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