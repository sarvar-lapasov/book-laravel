<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Photo;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreated;




class PostController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        // $this->middleware('password.confirm')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $posts = Post::latest()->paginate(6);
       return PostResource::collection($posts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize('create',Post::class);

         $post =  Post::create([
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
        ]);


        if($request->file('photo')){
        
            $path = $request->file('photo')->store('post-photos');
            $post->photos()->create(['url'=> $path]);
          }
        $users = User::get();
        $admin = [];
        foreach($users as $user){
            if($user->hasRole("admin")||$user->hasRole("creator")){
                $admin[] = $user;
            }
        }
          Notification::send($admin, new PostCreated($post));

        return $this->success('post created', $post);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
      return $this->response(new PostResource($post));

    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        //  if($request->hasFile('photo')){
        //  if(isset($post->photos()->get()[0]->url)){
        //     Storage::delete($post->photos()->get()[0]->url);
        //     $post->photos()->delete();
        // }
        //     $path = $request->file('photo')->store('post-photos');
        //     $post->photos()->create(['url'=> $path]);
        //   }
        
        $post->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
        ]);
        
        return $this->success('post updated', $post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if(isset($post->photos()->get()[0]->url)){
            Storage::delete($post->photos()->get()[0]->url);
            $post->photos()->delete();
        }
        
        $post->delete();
     
        return $this->success('post deleted', $post);
    }
}
