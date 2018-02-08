<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Comment;

class Blog extends Model
{
	protected $fillable = [
    'blog_title', 'blog', 'allow'
  ];

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
			->paginate(5);
			return $blogs;
    }

    public static function viewuserBlogs($user_id){ // users/home
    	$blogs = \DB::table('blogs')
			->select('blogs.*')
			->where('user_id', '=', $user_id)
			->get();
			return $blogs;
    }

    public static function openBlogs($id){ // open blog on welcome
    	$blogs = \DB::table('blogs AS b')
			->select('u.name', 'b.*')
			->join('users AS u', 'b.user_id', '=', 'u.id')
			->where('b.id', '=', $id)
			->get();
			return $blogs;
    }

    public static function viewComments($id){ // view comments on openblog.blade
    	$comment = \DB::table('blogs AS b')
			->select('commentor_name', 'comment', 'comment_date')
			->join('comments AS c', 'b.id', '=', 'c.blog_id')
			->where('b.id', '=', $id)
			->orderBy('comment_date', 'desc')
			->paginate(5);
			return $comment;
    }

    public static function addBlog($user_id, $blog_title, $blog){ // add blog on users/home.blade
			$qry = \DB::table('blogs')
			->insert(['blog_title' => $blog_title, 'blog' => $blog, 'user_id' => $user_id, 'blog_date' => NOW(), 'allow' => '1']);
			return $qry;
    }

    public static function selectBlogs(){ // select users for admin/admin
        $blog = \DB::table('blogs')
			->select('blogs.*', 'name')
			->join('users', 'blogs.user_id', '=', 'users.id')
			->orderBy('blog_date', 'desc')
			->paginate(10);
        return $blog;
    }

    public $timestamps = false;

}
