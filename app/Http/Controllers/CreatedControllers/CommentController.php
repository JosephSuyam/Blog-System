<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class CommentController extends Controller
{
	public function __construct(){
    $this->middleware('auth');
  }

  public function selectComment(){	// admin/admin/comment.blade
		$data['comment'] = Comment::orderBy('comment_date', 'desc')->paginate(10);
		return view('admin/comment', $data);
	}

	public function commentControl(Request $request){
		$comment_id = $request->comment_id;
		$comment = Comment::find($comment_id);
		$comment->delete();
		return redirect()->to('admin/comment')->with('message', 'Comment Deleted!');
	}
}
