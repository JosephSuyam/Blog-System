<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function userToBlog()
    {
    	return $this->hasMany('Blogs'); // read as user hasmany blog on user.id=blog.blogger_id
    }

    public static function openBlogs($id){ // open blog on welcome
    	$blogs = \DB::table('users AS u')
		->select('name', 'b.*')
		->join('blogs AS b', 'u.id', '=', 'b.user_id')
		->where('b.id', '=', $id)
		->first();
		return $blogs;
    }

    public static function authors(){ // select users for admin/admin
        $users = \DB::table('users')
        ->select('users.*')
        ->where('access', '!=', 2)
        ->paginate(1);
        return $users;
    }

    // public $timestamps = false;

}
