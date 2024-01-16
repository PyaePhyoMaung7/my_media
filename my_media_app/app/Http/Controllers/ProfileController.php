<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index(){
        $id = Auth::user()->id;
        $userData = User::select('id','name','email','phone','address','gender')->where('id', $id)->first();
        return view('admin.profile.index', compact('userData'));

    }

    //update admin profile
    public function updateAdminAccount(Request $request){
        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        };

        $userData = $this->getUserData($request);
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Account Updated Successfully']);
    }

    //direct change password
    public function directChangePassowrd(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $validator = $this->passwordValidationCheck($request);
        if($validator->fails()){
            return back()-> withErrors($validator)->withInput();
        };

        $dbPassword = User::where('id', Auth::user()->id)->first()->password;

        $hashedNewPassword = Hash::make($request->newPassword);

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id', Auth::user()->id)->update([
                'password'=>$hashedNewPassword,
                'updated_at'=>Carbon::now()
            ]);
             return redirect()->route('dashboard');
        }else{
            return back()-> with(['oldPasswordError'=>'Old Password is wrong!']);
        };


    }

    //get user info
    private function getUserData($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    //validate profile update data
    private function userValidationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required|max:255',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'Name is required',
            'adminEmail.required' => 'Email is required',
        ]);
    }

    //password validation check
    private function passwordValidationCheck($request){
        $validationRules = [
            'oldPassword' =>  'required|min:8|max:15',
            'newPassword' =>  'required|min:8|max:15',
            'confirmPassword' =>  'required|min:8|max:15|same:newPassword',
        ];

        $validationMessages = [
            'confirmPassword.same' => 'Confirm Password & New Password must be the same.',

        ];

        return Validator::make($request->all(), $validationRules, $validationMessages);
    }
}
