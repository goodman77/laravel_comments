<?php

namespace App\Http\Controllers;

use Validator;
use App\Comment;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CommentController extends Controller
{
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	

    /**
     * add comment function/ with validation
     *
     * @param  array  $request
     * @return Json response
     */
    public function add(Request $request)
	{
		// check validation 
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:15|alpha',
            'comment' => 'required|max:250',
        ]);

        if ($validator->fails()) {
			$errors = $validator->errors();
            return response()->json(['error' => $errors]);
        }
		
		// if validation failed 
		
		// get the request info from the form
    	$name = $request->name;
    	$parent_id = $request->parent_id;
    	$commentBody = $request->comment;
		
		// create a user ( assumming each time is a new user / new name)
        $user = new User;
		$user->name = $name;
		$user->save();
		
		// create a new comment with user_id
	    $comment = new Comment;
	    $comment->user_id = $user->id;
		$comment->post_id = 1; // assuming we have one page
	    $comment->parent_id = $parent_id;
	    $comment->comment = $commentBody;
	    $comment->save();
		
	    $id = $comment->id;
		$date = $comment->updated_at->diffForHumans();
		
    	return response()->json(['id' => $id, 'comment' => $commentBody, 'name' => $name, 'date' => $date]);

    }
}
