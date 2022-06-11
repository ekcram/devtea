<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Events\AlguienHaPublicadoEvent;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request) {

        $data = $request->only(['content', 'user_id','parent_id']);

        if((auth()->user()->id != $data['user_id']) && (!auth()->user()->is_friends_with($request->user_id))) {
            return back()->withErrors(['message' => 'Para publicar debes ser amigos.']);
        }

        if((auth()->user()->id != $data['user_id']) && (auth()->user()->is_friends_with($data['user_id']))) {
            $post = Post::create([
                'content' => $data['content'],
                'parent_id' => $data['user_id'],
                'user_id' => auth()->user()->id
            ]);

            $user = User::where('id', $data['user_id'])->first();
            event(new AlguienHaPublicadoEvent($user, auth()->user()));
            return back();
        }
        if((auth()->user()->id = $data['user_id'])) {
            auth()->user()->posts()->create([
                'content' => $data['content'],
            ]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        if((auth()->user()->id != $post->user_id) && (!auth()->user()->is_friends_with($post->user_id))) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id != $post->parent_id)) {
            return back()->withErrors(['message' => 'You do not have permission to delete this post!']);
        }
        if((auth()->user()->id != $post->user_id) && (auth()->user()->id = $post->parent_id)) {
            $post->delete();
            return back();
        }
        if((auth()->user()->id = $post->user_id)) {
            $post->delete();
            return back();
        }
    }
}