<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {

        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // これはデータベースに入力した値を保存している
    public function store(StoreCommentRequest $request, Post $post)
    {
        // $request->allでfillableも代入している
        $comment = new Comment($request->all());
        // $comment->body = $request->bodyと似ている
        // この時点でqueryは実行されてしまっているため、変数で引き継ぐことはできない!!!
        $comments_id = Comment::where('post_id', $post->id);
        preg_match_all('/@(\w+)/', $request->body, $matches);
        // リストを指定してそこに入れていく！！！
        foreach ($matches[1] as $mentioned_comment_id) {
            $first_mentioned_comment_id = $comments_id->where('comment_id', $mentioned_comment_id)->first();
            if ($first_mentioned_comment_id) {
                $comment->mention_id_1 = $first_mentioned_comment_id->id;
                // 通知などの処理を追加
            }
        }

        // commentsの紐づいているイメージが難しい
        try {
            $comment_max = Comment::where('post_id', $post->id)->max('comment_id');
            if (!isset($comment_max)) {
                $comment_max = 0;
            }
            $comment->comment_id = $comment_max + 1;
            $post->comments()->save($comment);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
        return redirect()
            ->route('posts.show', $post)
            ->with('notice', 'コメント登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, Comment $comment)
    {
        return view('comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
        // このcommentは引数からidを指定しなくてもよい
        if ($request->user()->cannot('update', $comment)) {
            return redirect()->route('posts.show', $post)
                ->withErrors('自分のコメント以外は更新できません');
        }
        // ここでbodyを受け取ることができる
        $comment->fill($request->all());

        try {
            $comment->save();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
        // ここのshowはpostcontollorerのshowに飛んでいる
        return redirect()->route('posts.show', $post)
            ->with('notice', 'コメントを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        try {
            $comment->delete();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
        return redirect()->route('posts.show', $post)
            ->with('notice', 'コメントを削除しました');
    }
}
