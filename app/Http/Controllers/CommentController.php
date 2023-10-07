<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentCreated;


class CommentController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {

        $post = Post::find($request->post_id);
        $user = User::find($post->user->id);

        $comment = Comment::create([
            'post_id'=>$request->post_id,
            'user_id'=>auth()->user()->id,
            'body'=>$request->body,
        ]);


        if($user->id !== $comment->user->id){
            Notification::send($user, new CommentCreated($comment));
        }
        return $this->success('comment created', $comment);
       

       
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
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update([
            'body'=>$request->body,
            'status'=>true
        ]);
         return $this->success('comment updated', $comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    
        return $this->success('comment deleted', $comment);
    }
}
