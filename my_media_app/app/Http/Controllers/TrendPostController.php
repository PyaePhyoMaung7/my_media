<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index(){
        $posts = ActionLog::select('posts.*', DB::raw('COUNT(*) AS view_count'))
                ->groupBy('action_logs.post_id')
                ->join('posts','posts.post_id','action_logs.post_id')
                ->orderBy('view_count', 'DESC')
                ->get();

        return view('admin.trend_post.index',compact('posts'));
    }

    //direct trend post details page
    public function trendPostDetails($id){
        $post = Post::select('c.title as category_title','posts.*')
        ->where('post_id',$id)
        ->leftJoin('categories as c','posts.category_id','c.category_id')
        ->first();

        $viewCount = ActionLog::where('post_id',$id)->count();
        return view('admin.trend_post.details',compact('post','viewCount'));
    }
}
