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

	public function openBlogs($id){ // open blog on welcome
		$data['blog'] = User::openBlogs($id);
		$data['comments'] = Blog::viewComments($id);
		return view('users/openblog', $data);
	}
}
