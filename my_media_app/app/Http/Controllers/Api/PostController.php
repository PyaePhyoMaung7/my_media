<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all posts
    public function getAllPosts(){
        // $posts = Post::select('posts.*','categories.title as category')
        // ->join('categories','posts.category_id','categories.category_id')

        $posts = Post::get();
        return response()->json([
            'status'=>'success',
            'posts'=>$posts,
        ]);
    }

    //search category
    public function postSearch(Request $request){
        // logger($request->all());
        $posts = Post::where('title','like','%'.$request->key.'%')
        ->orWhere('description','like','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $posts,
        ]);
    }

    //post details
    public function postDetails(Request $request){
        $post = Post::where('post_id',$request->postId)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}
