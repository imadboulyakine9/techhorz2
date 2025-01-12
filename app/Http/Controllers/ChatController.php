<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Chat;

class ChatController extends Controller
{
    public function addComment(Request $request, $article_id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Chat::create([
            'user_id' => Auth::id(),
            'article_id' => $article_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('status', 'Comment added successfully');
    }

    public function getComments($article_id)
    {
        $comments = Chat::where('article_id', $article_id)->with('user')->get();

        return view('comments.index', compact('comments'));
    }

    public function deleteComment($comment_id)
    {
        $comment = Chat::find($comment_id);

        if ($comment->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment');
        }

        $comment->delete();

        return redirect()->back()->with('status', 'Comment deleted successfully');
    }
}