<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_type==1){
                return view('admin.dashboard');
            }
            elseif(Auth::user()->user_type==2){
                return view('teacher.dashboard');
            }
            elseif(Auth::user()->user_type==3){
                return view('student.dashboard');
            }
            elseif(Auth::user()->user_type==4){
                return view('parent.dashboard');
            }
        }
        return  view('auth.login');
    }

    public function Authlogin(Request $request){

       $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt (['email'=>$request->email ,'password'=> $request->password],$remember)){

            if(Auth::user()->user_type==1){
                return view('admin.dashboard');
            }
            elseif(Auth::user()->user_type==2){
                return view('teacher.dashboard');
            }
            elseif(Auth::user()->user_type==3){
                return view('student.dashboard');
            }
            elseif(Auth::user()->user_type==4){
                return view('parent.dashboard');
            }


        }else{
            return redirect()->back()->with('error','Please Type Correct User Name & Password');
        }
       }

      public function logout(){
        Auth::logout();
        return redirect(url(''));
      }
}
