<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to change the password.');
        }
    
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
    
        $user = auth()->user(); // Retrieve the authenticated user using auth() helper
    
        $hashedPassword = $user->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password has been changed successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password is invalid');
        }
    }

    public function updatePass(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name =  $request['name'];
            $user->email = $request ['email'];

            $user->save();
            return Redirect()->back()->with('success','User Profile is update Successfully');
        }else{
            return Redirect()->back();
        }

    }
    
}
