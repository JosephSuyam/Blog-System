<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class BlogController extends Controller
{
    public function viewAllBlogs(){ // welcome
		$blogs = Blog::getAllowedBlog();
		return view('welcome', compact('blogs'));
	}

	public function viewUserBlogs(){ // users/home
		$blogs = Blog::viewuserBlogs();
		return view('users/home', compact('blogs'));
	}

	public function viewCreatedBlogs(){ // users/addblog
		$blogs = Blog::viewuserBlogs();
		return view('users/addblog', compact('blogs'));
	}

	public function openBlogs($id){ // open blog on welcome
		$data['blog'] = User::openBlogs($id);
		$data['comments'] = Blog::viewComments($id);
		return view('users/openblog', $data);
	}

	public function viewSelectedBlog($id){ // open blog selected on users/home/{blog_id}
		$blog = Blog::openBlogs($id);
		return view('users/home', $blog);
	}

	public function addBlog(Request $request){
		$blog_title = $request->blog_title;
		$blog = $request->blog;
		$user_stuff = auth()->user();
		$user_id = $user_stuff->id;
		if(isset($blog_title) && isset($blog) && !empty($blog_title) && !empty($blog)){
			$blogs = Blog::addBlog($user_id, $blog_title, $blog);
			return redirect()->to('users/addblog')->with('message', 'Your blog have been saved!');
		}else{
			return redirect()->to('users/addblog')->with('message', 'Please fill up all forms.');
		}
	}
}
