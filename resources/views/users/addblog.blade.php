@extends('layout.layout')

@section('content')
    <div class="container">
        <a href="home"><button class="btn btn-danger" style="float: right;">Go to Home Page</button></a>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class = "row">
            <div class = "col-sm-5">
                <div class = "panel panel-default" style="">
                    <div class = "panel-heading" style="font-size: 30px;">
                        <center>My Blogs</center>
                    </div>
                    <div class = "panel-body" style = "width: 100%; font-size: 20px;">
                        <!--SHOW MYBLOGS-->
                        @foreach($blogs as $blog)
                            @if(isset($blog))
                                <li>
                                    <a href="{{ (strpos($_SERVER['REQUEST_URI'], '/home/')) ? $blog->id : 'home/'.$blog->id }}">
                                        {{ $blog->blog_title }}
                                    </a>
                                </li>
                            @else
                                <span>You have no blogs yet</span>
                            @endif
                        @endforeach
                    </div><!--panel-body-->
                </div><!--panel-->
            </div>
            <div class="col-sm-7">
                <form method="POST" action="addblog/new">
                    {{ csrf_field() }}
                    <div class = "panel panel-default" style="">
                        <div class = "panel-heading" style="background-color: #FFFFFF;">
                            <input type="text" name="blog_title" placeholder="New Blog Title" value="" style="width: 100%; font-size: 30px; outline: none; border: 0;" placeholder="New blog title here...">
                        </div>
                        <div class = "panel-body" style = "width: 100%;">
                            <textarea name="blog" placeholder="Write your new blog here..." style="width: 100%; font-size: 20px; margin-top: 12px; height: 250px; resize: vertical; outline: none; border: 0;" placeholder="Write your new blog here..."></textarea>
                        </div><!--panel-body-->
                    </div><!--panel-->
                    <button type="submit" name="saveButton" class="btn btn-info" style="float: right; margin-right: ;">Save</button>
                </form>
            </div>
        </div>
        @if(Session::has('message'))
            <div class="form-group"><center>
                <div class="alert alert-info" style="width: 50%;"><a href="" class="close" data-dismiss="alert">&times;</a><strong>{{ Session::get('message') }}</strong></div>
            </center></div>
        @endif
    </div>
@endsection