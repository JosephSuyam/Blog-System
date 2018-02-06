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

    public $timestamps = false;
}
