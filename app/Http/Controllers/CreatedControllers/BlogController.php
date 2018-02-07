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
		// if(\Auth::check()){
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$blogs = Blog::viewuserBlogs($user_id);
			return view('users/home', compact('blogs'));
		// }else{
		// 	die('user no logger in1');
		// 	return redirect()->to('/');
		// }
	}

	public function viewCreatedBlogs(){ // users/addblog
		// if(\Auth::check()){
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$blogs = Blog::viewuserBlogs($user_id);
			return view('users/addblog', compact('blogs'));
		// }else{
		// 	die('user no logger in2');
		// 	return redirect()->to('/');
		// }
	}

	public function openBlogs($id){ // open blog on welcome
		$data['blog'] = User::openBlogs($id);
		$data['comments'] = Blog::viewComments($id);
		return view('users/openblog', $data);
	}

	public function viewSelectedBlog($id){ // open blog selected on users/home/{blog_id}
		$data['blogs'] = Blog::openBlogs($id);
		return view('users/home', $data);
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

	public function selectBlog(){	// admin/admin/blog.blade
		$blog = Blog::selectBlogs();
		return view('admin/blog', compact('blog'));
	}

	public function blogControl(Request $request){
		$blog_id = $request->blog_id;
		$blog = Blog::find($blog_id);
		if(isset($_POST['publish'])){
			$blog->allow = 0;
			$blog->save();
			return redirect()->to('admin/blog')->with('message', 'Blog unpublished!');
		}elseif(isset($_POST['unpublish'])){
			$blog->allow = 1;
			$blog->save();
			return redirect()->to('admin/blog')->with('message', 'Blog Published!');
		}else{
			return redirect()->to('admin/blog')->with('message', 'No blog selected.');
		}
	}
}
