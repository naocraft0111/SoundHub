<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Mail\CommentNotification;
use Illuminate\Support\Facades\Mail;
class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Comment $comments)
    {
        $comments->fill($request->all());
        $comments->save();

        // コメントを投稿したユーザー
        $user = $request->user();

        // コメントを受け取ったユーザー
        $recipient = $comments->article->user;

        // ユーザーIDが自分自身でない場合にのみメール通知を送信する
        if($user->id !== $recipient->id) {
            // メールクラスをインスタンス化して、メールの内容を設定する
            $mail = new CommentNotification($user, $recipient, $comments);

            // メールを送信する
            Mail::to($recipient->email)->send($mail);
        }

        toastr()->success('コメントを投稿しました');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        toastr()->success('コメントを削除しました');
        return back();
    }
}
