<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class CommentController extends Controller
{
    public function selectComment(){	// admin/admin/comment.blade
		$data['comment'] = Comment::paginate(10);
		return view('admin/comment', $data);
	}
}
