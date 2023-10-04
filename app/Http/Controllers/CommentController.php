<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required'
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        return new CommentResource($comment->loadMissing(['comentator:id,username']));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comments_content' => 'required'
        ]);


        $comment = Comment::findOrFail($id);
        $comment->update($validated);

        return new CommentResource($comment->loadMissing(['comentator:id,username']));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return new CommentResource($comment->loadMissing(['comentator:id,username']));
    }
}
