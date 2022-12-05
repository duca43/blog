<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Mail\CommentReceived;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    //public function store($id)
    public function store(StoreCommentRequest $request, $id) {
        $validated = $request->validated();

        $post = Post::find($id);

        $post->addComment($validated['body']);

        Mail::to($post->user)->send(new CommentReceived($post));

        // Comment::create([
        //     'body' => request('body'),
        //     'post_id' => $id
        // ]);

        return redirect()->back();
    }
}
