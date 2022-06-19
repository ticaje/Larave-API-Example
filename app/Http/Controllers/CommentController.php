<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function save(PostFormRequest $request)
    {
        //on_post, from_user, body
        $input['author_id'] = $request->user()->id;
        $input['post_id'] = $request->input('post_id');
        $input['content'] = $request->input('body');
        $slug = $request->input('slug');
        Comment::create($input);

        return redirect($slug)->with('message', 'Comment published');
    }
}
