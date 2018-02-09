@extends('layout.layout')

@section('content')
    <div class = "row" style="min-width: 100%; width: 100%;">
        <div class = "col-sm-12" style="margin-left: 15px;">
            <a href="/newblogsystem/public"><button class="btn btn-outline-danger" style="float: right;">Go to Previous Page</button></a>
            <!-- SHOW THE SELECTED BLOG-->
            
            <div style="font-size: ;"><h1>{{ $blog->blog_title }}</h1><hr class="hrstyle">
                <cite>by</cite> {{ $blog->name }} <span style="color: #afafaf;">{{ compDates($blog->blog_date) }}</span><br><span style="font-size: 20px;">{{ $blog->blog }}</span>
            </div><br>
            <div ng-app="myApp" ng-controller="myCtrl">
                <div style="font-size: 18px; margin-left: 15px;">
                    @foreach($comments as $comment)
                        <div><img src="{{ asset('img/user.png') }}" style="width: 25px; margin-bottom: 5px;"/>&nbsp;&nbsp;{{ $comment->commentor_name }} said {{ $comment->comment }} <cite style="color: #afafaf;"> {{ compDates($comment->comment_date) }} </cite></div>
                    @endforeach
                    <div id="newcomment" style="display: ;" ng-show="commentor_name.length > 0">
                        <img src="{{ asset('img/user.png') }}" style="width: 25px; margin-bottom: 5px;"/>&nbsp;&nbsp;@{{ commentor_name }} said 
                        @{{ comment }}
                    </div>
                </div>
                {{ $comments->links() }}
                <div style="margin-left: 15px;"><h3>Leave a comment:</h3>
                    <form method="POST" action="{{ $blog->id }}/comment">
                        {{ csrf_field() }}
                        <div class="row form-group" style="margin-left: 20px;">
                            <input type="text" name="commentor_name" ng-model="commentor_name" id="commentor_name" placeholder="Name" class="form-control" style="width: 50%" >
                            <textarea name="comment" ng-model="comment" id="comment" placeholder="Write your comment here..." class="form-control" style="width: 50%; font-size: 20px; margin-top: 12px; height: 250px; resize: vertical;" ></textarea>
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <input type="hidden" name="blog_title" value="{{ $blog->blog_title }}">
                            <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send Comment</button>
                        </div>
                    </form><br>
                </div>
                @if(Session::has('message'))
                    <div class="form-group"><center>
                        <div class="alert alert-info" style="width: 40%;"><a href="author_panel.php" class="close" data-dismiss="alert">&times;</a><strong>{{ Session::get('message') }}</strong></div>
                    </center></div>
                @endif
            </div>
        </div>
    </div>
    <script>
        // if($('#commentor_name').is(':empty') || $('#comment').is(':empty')){
            newcomment.style.display = "display";
            var app = angular.module('myApp', []);
            app.controller('myCtrl', function($scope) {  
            $scope.commentor_name = "";
            $scope.comment = "";  
            });
        // }else{
        //     alert('yeahyeah');
        //     newcomment.style.display = "none";
        // }
    </script>
@endsection