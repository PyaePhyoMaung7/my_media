<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File as File1;

class PostController extends Controller
{
    //direct post page
    public function index(){
        $key = '';
        $categories = Category::get();
        $posts = Post::orderBy('post_id','desc')->get();
        return view('admin.post.index', compact('categories','posts','key'));
    }

    //create post
    public function createPost(Request $request){
        $validator = $this->postValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };

        if($request->hasFile('postImage')){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);

            $postData = $this->getPostData($request, $fileName);
        }else{
            $postData = $this->getPostData($request, null);
        }


        Post::create($postData);

        return back()->with(['createSuccess'=>'Post successfully created!']);

    }

    //delete post
    public function deletePost($id){
        $dbImage = Post::where('post_id',$id)->first()->image;

        Post::where('post_id',$id)->delete(); //delete post in database
        ActionLog::where('post_id',$id)->delete(); //delete action logs of the deleted post

        if(File1::exists(public_path().'/postImage/'.$dbImage)){
            File1::delete(public_path().'/postImage/'.$dbImage);
        }

        return back()->with(['deleteSuccess'=>'Post successfully deleted']);


    }

    //direct update post page
    public function updatePostPage($id){
        $key = '';
        $categories = Category::get();
        $posts = Post::orderBy('post_id','desc')->get();
        $post = Post::where('post_id',$id)->first();
        return view('admin.post.update',compact('categories','key','posts','post'));
    }

    //update post
    public function updatePost($id, Request $request){
        $validator = $this->postValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };


        $this->storeNewImageAndUpdate($id, $request);

        return back()->with(['updateSuccess'=>'Post successfully updated']);
    }

    //validate post
    private function postValidationCheck($request){
        return Validator::make($request->all(),[
            'postTitle'=>'required|min:3',
            'postDescription'=>'required|min:3',
            'postImage'=>[File::types('jpg,png,jpeg,webp,avif')->max('1mb')],
            // 'postImage'=>'mimes:png,jpg,jpeg,webp|min()',
            'postCategory'=>'required'
        ]
        );
    }

    //get update data
    private function getUpdateData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now(),
        ];
    }

    //store new Image and update
    private function storeNewImageAndUpdate($id, $request){
        //get old image name from database
        $dbImage = Post::where('post_id',$id)->first()->image;

        //prepare update array
        $postData = $this->getUpdateData($request);

        if(isset($request->postImage)){ //or $request->hasFile('postImage')
            //delete old image
            if(File1::exists(public_path().'/postImage/'.$dbImage)){
                File1::delete(public_path().'/postImage/'.$dbImage);
            }

            //prepare new image
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);

            $postData['image'] = $fileName;

        }

        Post::where('post_id',$id)->update($postData);
    }

    //get post data
    private function getPostData($request, $fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
