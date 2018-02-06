<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Comment;

class Blog extends Model
{
	public function blogToUser()
    {
    	return $this->belongsTo('Users'); // read as blog belongsTo users on blog.blogger_id=user.id
    }

    public function blogToComment()
    {
    	return $this->hasMany('Comments');
    }

    public static function getAllowedBlog(){ // welcome
    	$blogs = \DB::table('blogs')
		->select('name', 'blogs.*')
		->join('users', 'blogs.user_id', '=', 'users.id')
		->where('allow', '=', 1)
		->orderBy('blog_date', 'desc')
		->get();
		return $blogs;
    }

    public static function viewuserBlogs(){ // users/home
    	$user_stuff = auth()->user();
		$user_id = $user_stuff->id;
    	$blogs = \DB::table('blogs')
		->select('blogs.*')
		->where('user_id', '=', $user_id)
		->get();
		return $blogs;
    }

    public static function openBlogs($id){ // open blog on welcome
    	$blogs = \DB::table('blogs')
		->select('name', 'blogs.*')
		->join('users', 'blogs.user_id', '=', 'users.id')
		->where('id', '=', $id)
		->get();
		return $blogs;
    }

    public static function viewComments($id){ // view comments on openblog.blade
    	$comment = \DB::table('blogs')
		->select('commentor_name', 'comment', 'comment_date')
		->join('comments', 'blogs.blog_id', '=', 'comments.commented_blog')
		->where('blog_id', '=', $id)
		->orderBy('comment_date', 'desc')
		->paginate(5);
		return $comment;
    }

    public $timestamps = false;

}
