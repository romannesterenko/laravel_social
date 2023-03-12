<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()
                ->route('home');
        }
        return view('login');
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::where('email', $request->email)->first();
        if($user){
            Auth::login($user);
            return redirect()
                ->route('home')
                ->withSuccess('You have Successfully login');
        }
        return redirect()->route('login')->withErrors('Oppes! You have entered invalid credentials');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect::back()->with('message','Operation Successful !');
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed|required_with:password_confirmation',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->pasword),
        ]);

        return redirect()->route('home')->withSuccess('You have signed-in');
    }
}
