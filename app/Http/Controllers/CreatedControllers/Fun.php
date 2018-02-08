<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class Fun extends Controller
{
	public function __construct(){
    $this->middleware('auth');
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

// 	public function showMyBlogs(){
// 		if(\Auth::check()){
// 			$user_stuff = auth()->user();
// 			$user_id = $user_stuff->id;
// 			$user_stuff = auth()->user();
// 			$user_id = $user_stuff->id;
// 			$users = \DB::table('blog')
// 			->select('blog.*')
// 			->where('blogger_id', '=', $user_id)
// 			->get();
// 			// ->paginate(2);
// 			return view('users/home', compact('users'));
// 		}else{
// 			return redirect()->to('/login');
// 		}
// 	}

// 	public function showMyBlogs2(){
// 		if(\Auth::check()){
// 			$user_stuff = auth()->user();
// 			$user_id = $user_stuff->id;
// 			$user_stuff = auth()->user();
// 			$user_id = $user_stuff->id;
// 			$users = \DB::table('blog')
// 			->select('blog.*')
// 			->where('blogger_id', '=', $user_id)
// 			->get();
// 			return view('addblog', compact('users'));
// 		}else{
// 			return redirect()->to('/login');
// 		}
// 	}

// // CREATE SYNTAX (CHECK ALSO ROUTES/WEB.PHP)

// 	public function newBlog(Request $request){
// 		$blog_title = $request->blog_title;
// 		$blog = $request->blog;
// 		$user_stuff = auth()->user();
// 		$user_id = $user_stuff->id;
// 		if(isset($blog_title) && isset($blog) && !empty($blog_title) && !empty($blog)){
// 			$qry = \DB::table('blog')
// 			->insert(
// 				['blog_title' => $blog_title, 'blog' => $blog, 'blogger_id' => $user_id, 'blog_date' => NOW(), 'allow' => '1']
// 				);
// 			return redirect()->to('/home')->with('message', 'Your blog have been saved!');
// 		}else{
// 			return redirect()->to('/home')->with('message', 'Please fill up all forms.');
// 		}
// 	}
}
