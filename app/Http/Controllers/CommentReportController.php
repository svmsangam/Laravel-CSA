<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\commentReportNotification;

class CommentReportController extends Controller
{
    //
    public function create($id){
        $comment = Comment::findOrFail($id);
        $comment->increment('reported');
        $userId = $comment->user_id;
        $user = User::findOrFail($userId);
        Notification::send($user, new commentReportNotification($comment->body));
        return redirect()->back()->with('success','Reported');
    }
}
