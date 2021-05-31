<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        Profile::create(['user_id'=>$user->id]);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    public function getUser($user_id){
        $user = User::find($user_id);
        $userProfile = Profile::where('user_id',$user_id)->first();
        $userData = [
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$userProfile->phone,
            'designation'=>$userProfile->designation,
            'area'=>$userProfile->area,
            'city'=>$userProfile->city,
            'country'=>$userProfile->country,
            'zip'=>$userProfile->zip,
        ];
        return response($userData);
    }
    public function userList(){
        $list = User::all();
        return response($list);
    }
    public function profileUpdate(Request $request, $user_id){
        Profile::where('user_id',$user_id)->update([
            'phone'=>$request->phone,
            'designation'=>$request->designation,
            'area'=>$request->area,
            'city'=>$request->city,
            'country'=>$request->country,
            'zip'=>$request->zip,
        ]);
        return response('Profile updated');
    }
}
