@extends('layout.layout')

@section('content')
    <div class="container">
        <a href="/newBlog/public/users/home"><button class="btn btn-danger" style="float: right;">Go to Home Page</button></a>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class = "row">
                    <div class = "col-sm-5">
                        <div class = "panel panel-default" style="min-width: 65%;">
                            <div class = "panel-heading" style="font-size: 30px;">
                                <center>Control Panel</center>
                            </div>
                            <div class = "panel-body" style = "width: 100%;"><center>
                                <a href="admin"><button type="submit" name="users" class="btn btn-default" style="margin-bottom: 25px; width: 50%;">Authors</button></a><br>
                                <a href="blog"><button type="submit" name="blog" class="btn btn-default" style="margin-bottom: 25px; width: 50%;">Blogs</button></a><br>
                                <a href="comment"><button type="submit" name="comment" class="btn btn-default" style="margin-bottom: 25px; width: 50%;">Comments</button></a>
                            </center></div><!--panel-body-->
                        </div><!--panel-->
                    </div>
                    <div class="col-sm-7">
                        <div class = "panel panel-default" style="min-width: 65%;">
                            <div class = "panel-body" style = "width: 100%;">
                                <!-- view accounts, blogs, comments -->
                                <div id="comments">
                                    @foreach($comment as $comments)
                                        <form method="POST" action="admin/{{ $comments->comment_id }}/comment">
                                        {{ csrf_field() }}
                                            <button type="submit" name="delete" style="background-color: #FFFFFF; border: 0; color: #001687;">Delete</button> |&nbsp;
                                            <span style="color: #afafaf;">{{ $comments->commentor_name }} said</span> {{ $comments->comment }} <cite style="color: #afafaf;"> {{ compDates($comments->comment_date) }}</cite>
                                            <input type="hidden" name="comment_id" value="{{ $comments->comment_id }}">
                                        </form>
                                    @endforeach
                                    {{ $comment->links() }}
                                </div>
                            </div><!--panel-body-->
                        </div><!--panel-->
                    </div>
                </div>
                @if(Session::has('message'))
                    <div class="form-group"><center>
                        <div class="alert alert-info" style="width: 50%;"><a href="author_panel.php" class="close" data-dismiss="alert">&times;</a><strong>{{ Session::get('message') }}</strong></div>
                    </center></div>
                @endif
            </div>
        </div>
    </div>
@endsection