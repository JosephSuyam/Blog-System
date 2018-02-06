<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Blog;

class Comment extends Model
{
    public function commentToBlog()
    {
    	return $this->hasMany('Blogs');
    }

    public static function selectComments(){ // select users for admin/admin
        $comment = \DB::table('comments')
		->select('comments.*')
		->paginate(10);
        return $comment;
    }

    public $timestamps = false;
}
