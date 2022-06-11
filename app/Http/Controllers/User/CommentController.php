<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;

class CommentController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request, Post $post)
    {
        if(auth()->user()->id != $request->user_id && (!auth()->user()->is_friends_with($request->user_id))){
            return back();
        }

        if((auth()->user()->id != $request->user_id) && (auth()->user()->is_friends_with($request->user_id))) {
            auth()->user()->comments()->create([
                'content' => $request->content,
                'post_id' => $post->id,
            ]);
            return back();
        }

        if((auth()->user()->id = $request->user_id)) {
            auth()->user()->comments()->create([
                'content' => $request->content,
                'post_id' => $post->id,
            ]);
            return back();
        }
    }
}
