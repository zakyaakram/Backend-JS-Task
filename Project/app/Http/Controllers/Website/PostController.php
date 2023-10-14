<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware('auth')->except('index','show');
     }
    public function index()
    { 
       
        $posts = auth()->user()->posts;
        // $posts = $posts->latest()->paginate(1);
        return view('posts.index',compact('posts'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('posts.create',compact('categories'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // dd($request);
        $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('storage/posts'), $imageName);
        $post= Post::create([
            'title' => $request->title,
            'content' => $request->content,
            // auth()->user()->id
            'user_id' => auth()->id(),
            'image'=>$imageName
        ]);
       

        //attach [id,id,id,id]
        $post->categories()->attach($request->categories);
        return redirect()->route('home')->with('success','Post created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories=Category::all();
        $selectedCategories =$post->categories()->pluck('categories.id')->toArray();
        //  dd($selectedCategories);
        return view('posts.edit',compact('post','categories','selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        if($request->hasfile('image')){
            if(file_exists(public_path($post->image_path))){
                unlink(public_path($post->image_path));
            }
            $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('storage/posts'), $imageName);

        } 
        $post->update([
                'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>auth()->id(),
            'image'=>$imageName?? $post->image,

        ]);
        $post->categories()->sync($request->categories);
        return redirect()->route('home')->with('success', "Post Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(file_exists(public_path($post->image_path))){
            unlink(public_path($post->image_path));
        }
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully');

    }
}
