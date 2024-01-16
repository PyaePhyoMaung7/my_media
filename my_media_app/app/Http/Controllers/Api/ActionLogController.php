<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //set action log
    public function setActionLog(Request $request){
        $data = [
            'user_id' => $request->userId,
            'post_id' => $request->postId,
        ];

        ActionLog::create($data);//

        $views = ActionLog::where('post_id',$request->postId)->count();

        logger($views);

        return response()->json([
            'views' => $views,
        ]);
    }
}
