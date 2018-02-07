<?php

namespace App\Http\Controllers\CreatedControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Blog;
use App\Model\Comment;

class UserController extends Controller
{
	public function author(){	// admin/admin.blade
		$users = User::where('access', '!=', 2)->paginate(5);	// eloquent select with condition and pagination
		return view('admin/admin', compact('users'));
	}

	public function accessUser(Request $request){	// update access of users
		$id = $request->id;
		$user = User::find($id);
		if(isset($_POST['enable'])){
			$user->access = 0;
			$user->save();
			return redirect()->to('admin/admin')->with('message', 'User Access Disabled!');
		}elseif(isset($_POST['disable'])){
			$user->access = 1;
			$user->save();
			return redirect()->to('admin/admin')->with('message', 'User Access Enabled!');
		}else{
			return redirect()->to('admin/admin')->with('message', 'No user selected.');
		}
	}
	
}
