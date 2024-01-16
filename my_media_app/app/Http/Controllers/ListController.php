<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $searchKey = '';
        $users = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('users','searchKey'));
    }

    //delete admin account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin account successfully deleted!']);
    }

    //admin search
    public function adminSearch(Request $request){
        $searchKey = $request->adminSearchKey;
        $users = User::where('name', 'like', '%'.$searchKey.'%')
                ->orWhere('email', 'like', '%'.$searchKey.'%')
                ->orWhere('phone', 'like', '%'.$searchKey.'%')
                ->orWhere('address', 'like', '%'.$searchKey.'%')
                ->orWhere('gender', $searchKey)
                ->get();
        return view('admin.list.index',compact('users', 'searchKey'));
    }
}
