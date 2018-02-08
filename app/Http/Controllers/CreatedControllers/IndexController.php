<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class IndexController extends Controller
{
  public function viewAllBlogs(){ // welcome
		$blogs = Blog::getAllowedBlog();
		return view('welcome', compact('blogs'));
	}

	public function openBlogs($id){ // open blog on welcome
		$data['blog'] = User::openBlogs($id);
		$data['comments'] = Blog::viewComments($id);
		return view('users/openblog', $data);
	}
  
	public function comment(Request $request){ // add comment on openblog
		$blog_id = $request->blog_id;
		$commentor_name = $request->commentor_name;
		$comment = $request->comment;
		if(isset($commentor_name) && isset($comment)){
			$commentClass = new Comment();
			$commentClass->blog_id = $blog_id;
			$commentClass->commentor_name = $commentor_name;
			$commentClass->comment = $comment;
			$commentClass->comment_date = NOW();
			$commentClass->save();
			return back()->with('message', 'Comment uploaded');
		}else{
			return back()->with('message', 'Please fill up all forms');
		}
	}
	
}
