<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $this->validate($request,[
            'email'      => 'required',
            'password'    => 'required'
        ]);

        if (Auth::attempt([
            'email'=> $request->email,
            'password'=> $request->password,
            ])) {
                return response()->json([
                    'message'=>"success",
    
                ],200);
        }
        else{
            return response()->json([
                'error'=>"wrong cridentials."
            ],200);
        }
    }


    public function logout(){
        Auth::logout();
    }


    public function index(){
        $data = User::get();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }


    public function userStore(Request $request){
        $this->validate($request, [
            'name'  => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => 'required',
        ]);

        $user = new User;
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->role      = $request->type;
        $user->status      = $request->status;
        $user->password  = Hash::make($request->password);

        $user->save();
        return response()->json([
            'user'=>$user
        ],200);
    }

    public function updateUser(Request $request){

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email  = $request->email;
        $user->phone    = $request->phone;
        $user->role    = $request->role;
        $user->status    = $request->status;

        $user->save();
        return response()->json([
            'user'=> $user
        ],200);

    }

    public function deleteUserById(Request $request){
        $user = User::findOrFail($request->id)->delete();

        return response()->json([
            'user'=> $user
        ],200);
    }


























    // Another Way to Store Data
    // protected function validator(Request $request)
    // {
    //     return Validator::make($request, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:5', 'confirmed'],
    //     ]);
    // }

    // protected function userStore(Request $request)
    // {
    //     $user = User::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'phone' => $request['phone'],
    //         'role' => $request['type'],
    //         'password' => Hash::make($request['password']),
    //     ]);

    //     return response()->json([
    //         'user'=> $user
    //     ],200);
    // }
}
