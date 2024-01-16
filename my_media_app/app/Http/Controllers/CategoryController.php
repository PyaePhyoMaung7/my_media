<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function index(){
        $key = '';
        $categories = Category::orderBy('category_id','Desc')->get();
        return view('admin.category.index',compact('categories','key'));
    }

    //create category
    public function createCategory(Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back()->with(['createSuccess'=>'Category successfully created!']);
    }

    //delete Category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        Post::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess'=>'Category successfully deleted!']);
    }

    //category Search
    public function categorySearch(Request $request){
        $key = $request->categorySearchKey;
        $categories = Category::where('title','LIKE', '%'.$key.'%')
                    ->orWhere('description','LIKE', '%'.$key.'%')
                    ->get();
        return view('admin.category.index',compact('categories','key'));
    }

    //direct category edit page
    public function categoryEditPage($id){
        $category = Category::where('category_id',$id)->first();
        $key = '';
        $categories = Category::orderBy('category_id','Desc')->get();
        return view('admin.category.edit',compact('category','categories','key'));
    }

    //update category
    public function categoryUpdate($id, Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };

        $updateData = $this->getUpdateData($request);

        Category::where('category_id',$id)->update($updateData);

        return redirect()->route('admin#category')->with(['updateSuccess'=>'Category successfully updated']);


    }

    //get category data
    private function getCategoryData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //get category update data
    private function getUpdateData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now(),
        ];
    }

    //check category data
    private function categoryValidationCheck($request){
        $validationRules = [
            'categoryName' => 'required|min:3|max:15',
            'categoryDescription' => 'required|min:3|max:100',
        ];

        return Validator::make($request->all(), $validationRules );
    }

}
