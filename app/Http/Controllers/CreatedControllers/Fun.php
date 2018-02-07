<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class Fun extends Controller
{
	// public function viewAllBlogs(){ // welcome
	// 	$blogs = Blog::getAllowedBlog();
	// 	return view('welcome', compact('blogs'));
	// }

	// public function viewUserBlogs(){ // users/home
	// 	$blogs = Blog::viewuserBlogs();
	// 	return view('users/home', compact('blogs'));
	// }

	// public function openBlogs($id){ // open blog on welcome
	// 	$data['blog'] = User::openBlogs($id);
	// 	$data['comments'] = Blog::viewComments($id);
	// 	return view('users/openblog', $data);
	// }

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
		// $data['comments'] = Blog::viewComments($id);
		// return view('users/openblog', $data);
	}

	public function home(Request $request){	//  on users/home
		$blog_id = $_POST['blog_id'];
		$type = gettype($blog_id);
		$num = "1";
		$typeint = gettype($num);
		if($type==$typeint){
			if(isset($_POST['blog_id']) && !empty($_POST['blog_id'])){
				$blog_id = $request->blog_id;
				$blog_title = $request->blog_title;
				$blog = $request->blog;
				if(isset($_POST['delete'])){	// delete blog
					$blog = Blog::where(array('id'=>$blog_id));
					$blog->delete();
					$comment = Comment::where(array('blog_id'=>$blog_id));
					$comment->delete();
					return redirect()->to('users/home')->with('message', 'Blog Deleted!');
				}elseif(isset($_POST['publish'])){
					$blogs = Blog::publish($blog_id);
					return redirect()->to('users/home')->with('message', 'Blog Published!');
				}elseif(isset($_POST['unpublish'])){
					$blogs = Blog::unpublish($blog_id);
					return redirect()->to('users/home')->with('message', 'Blog Unpublished!');
				}elseif(isset($_POST['saveButton'])){
					$user_stuff = auth()->user();
					$user_id = $user_stuff->id;
					if(isset($blog_title) && isset($blog)){
						$blogs = Blog::editBlog($blog_id, $blog_title, $blog);
						return redirect()->to('users/home')->with('message', 'Your Blog have been Saved!');
					}else{
						return redirect()->to('users/home')->with('message', 'Please fill up all forms.');
					}
				}else{
					die("Check author_panel form");
				}
			}else{
				return redirect()->to('users/home')->with('message', 'Please select a blog.');
			}
		}else{
			die('error');
		}
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

	public function commentControl(Request $request){
		$comment_id = $request->comment_id;
		$comment = Comment::find($comment_id);
		$comment->delete();
		return redirect()->to('admin/comment')->with('message', 'Comment Deleted!');
	}

	// public function commentControl(Request $request){
	// 	$comment_id = $request->comment_id;
	// 	if(isset($_POST['delete'])){
	// 		$qry = \DB::table('comment')
	// 		->where('comment_id', $comment_id)
	// 		->delete();
	// 		return redirect()->to('/admin')->with('message', 'Comment Deleted!');
	// 	}else{
	// 		return redirect()->to('/admin')->with('message', 'No comment selected.');
	// 	}
	// }

	// public function author(){	// admin/admin.blade
	// 	$users = User::where('access', '!=', 2)->paginate(5);	// eloquent select with condition and pagination
	// 	return view('admin/admin', compact('users'));
	// }

	// public function selectBlog(){	// admin/admin/blog.blade
	// 	$blog = Blog::selectBlogs();
	// 	return view('admin/blog', compact('blog'));
	// }

	// public function selectComment(){	// admin/admin/comment.blade
	// 	$data['comment'] = Comment::paginate(10);
	// 	return view('admin/comment', $data);
	// }

	// public function addBlog(Request $request){
	// 	$blog_id = $_POST['blog_id'];
	// 	$type = gettype($blog_id);
	// 	$num = "1";
	// 	$typeint = gettype($num);
	// 	if($type==$typeint){
	// 		if(isset($_POST['blog_id']) && !empty($_POST['blog_id'])){
	// 			if(isset($_POST['delete'])){
	// 				$blog_id = $request->blog_id;
	// 				$qry = \DB::table('blog')
	// 				->where('blog_id', '=', $blog_id)
	// 				->delete();

	// 				$qry = \DB::table('comment')
	// 				->where('commented_blog', '=', $blog_id)
	// 				->delete();
	// 				return redirect()->to('/home')->with('message', 'Blog Deleted!');
	// 			}elseif(isset($_POST['publish'])){
	// 				$blog_id = $request->blog_id;
	// 				$qry = \DB::table('blog')
	// 				->where('blog_id', $blog_id)
	// 				->update(['allow' => 1]);
	// 				return redirect()->to('/home')->with('message', 'Blog Published!');
	// 			}elseif(isset($_POST['unpublish'])){
	// 				$blog_id = $request->blog_id;
	// 				$qry = \DB::table('blog')
	// 				->where('blog_id', $blog_id)
	// 				->update(['allow' => 0]);
	// 				return redirect()->to('/home')->with('message', 'Blog Unpublished!');
	// 			}elseif(isset($_POST['saveButton'])){
	// 				$blog_id = $request->blog_id;
	// 				$blog_title = $request->blog_title;
	// 				$blog = $request->blog;$user_stuff = auth()->user();
	// 				$user_id = $user_stuff->id;
	// 				if(isset($blog_title) && isset($blog)){
	// 					$qry = \DB::table('blog')
	// 					->where('blog_id', $blog_id)
	// 					->update(
	// 						['blog_title' => $blog_title, 'blog' => $blog]
	// 						);
	// 					return redirect()->to('/home')->with('message', 'Your Blog have been Saved!');
	// 				}else{
	// 					return redirect()->to('/home')->with('message', 'Please fill up all forms.');
	// 				}
	// 			}else{
	// 				die("Check author_panel form");
	// 			}
	// 		}else{
	// 			return redirect()->to('/home')->with('message', 'Please select a blog.');
	// 		}
	// 	}else{
	// 		die('error');
	// 	}
	// }

	// public function comments(Request $request){ // add comment on users/openBlogs
	// 	$commented_blog = $request->commented_blog;
	// 	$commentor_name = $request->commentor_name;
	// 	$comment = $request->comment;
	// 	if(isset($commentor_name) && isset($comment)){
	// 		$qry = \DB::table('comment')
	// 		->insert(
	// 			['commented_blog' => $commented_blog, 'commentor_name' => $commentor_name, 'comment' => $comment, 'comment_date' => NOW()]
	// 			);
	// 		return back()->with('message', 'Comment uploaded');
	// 	}else{
	// 		return back()->with('message', 'Please fill up all forms');
	// 	}
	// }

	// public function viewBlogs2(){
	// 	$users = \DB::table('users')
	// 	->select('name', 'blog_id', 'blog_title', 'blog_date', 'allow')
	// 	->join('blog', 'users.id', '=', 'blog.blogger_id')
	// 	->where('allow', '=', 1)
	// 	->paginate(5);
	// 	return view('welcome', compact('users'));
	// }

	// public function openBlog($id){
	// 	$users = \DB::table('users')
	// 	->select('name', 'blog_id', 'blog_title', 'blog', 'blog_date', 'allow')
	// 	->join('blog', 'users.id', '=', 'blog.blogger_id')
	// 	->where('blog_id', '=', $id)
	// 	->get();
	// 	return view('home', compact('users'));
	// }

	public function showMyBlogs(){
		if(\Auth::check()){
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$users = \DB::table('blog')
			->select('blog.*')
			->where('blogger_id', '=', $user_id)
			->get();
			// ->paginate(2);
			return view('home', compact('users'));
		}else{
			return redirect()->to('/login');
		}
	}

	public function showMyBlogs2(){
		if(\Auth::check()){
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$user_stuff = auth()->user();
			$user_id = $user_stuff->id;
			$users = \DB::table('blog')
			->select('blog.*')
			->where('blogger_id', '=', $user_id)
			->get();
			return view('addblog', compact('users'));
		}else{
			return redirect()->to('/login');
		}
	}

	// public function openBlog2($id){
	// 	$users = \DB::table('users')
	// 	->select('name', 'blog_id', 'blog_title', 'blog', 'blog_date', 'allow')
	// 	->join('blog', 'users.id', '=', 'blog.blogger_id')
	// 	->where('blog_id', '=', $id)
	// 	->get();

	// 	$comment = \DB::table('blog')
	// 	->select('commentor_name', 'comment', 'comment_date')
	// 	->join('comment', 'blog.blog_id', '=', 'comment.commented_blog')
	// 	->where('commented_blog', '=', $id)
	// 	->orderBy('comment_date', 'desc')
	// 	->paginate(5);
	// 	return view('openblog', compact('users', 'comment'));
	// }

// CREATE SYNTAX (CHECK ALSO ROUTES/WEB.PHP)

	public function newBlog(Request $request){
		$blog_title = $request->blog_title;
		$blog = $request->blog;
		$user_stuff = auth()->user();
		$user_id = $user_stuff->id;
		if(isset($blog_title) && isset($blog) && !empty($blog_title) && !empty($blog)){
			$qry = \DB::table('blog')
			->insert(
				['blog_title' => $blog_title, 'blog' => $blog, 'blogger_id' => $user_id, 'blog_date' => NOW(), 'allow' => '1']
				);
			return redirect()->to('/home')->with('message', 'Your blog have been saved!');
		}else{
			return redirect()->to('/home')->with('message', 'Please fill up all forms.');
		}
	}
}
