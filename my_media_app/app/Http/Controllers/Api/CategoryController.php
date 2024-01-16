<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all categories
    public function getAllCategories(){
        $categories = Category::select('category_id','title','description')->get();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    //search categroy
    public function categorySearch(Request $request){
        if(!empty($request->key)){
            $posts = Post::where('category_id',$request->key)->get();
        }else{
            $posts = Post::get();
        }

        return response()->json([
            'result' => $posts
        ]);
    }
}
