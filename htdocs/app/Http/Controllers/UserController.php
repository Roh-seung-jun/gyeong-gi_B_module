<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginPage(){

        if(auth()->user()) return redirect('/')->with('msg','로그인한 회원은 접근 불가능 합니다.');
        return view('login');
    }

    public function signPage(){
        return view('sign');
    }

    public function sign(Request $request){
        $request->validate([
            'id' => 'unique:users|required',
            'password' => 'required',
            'name'=> 'unique:users|required',
        ],[
            'required' => ":attribute는 필수값입니다.",
            'unique' => "이미 존재하는 아이디 또는 이름 입니다."
        ]);

        User::create($request->only(['name','id','password']));
        return redirect('/')->with('msg','회원가입이 완료되었습니다.');
    }

    public function login(Request $request){
        $user = User::find($request['id']);
        if(!$user || $user['password'] !== $request['password']) return back()->with('msg','아이디 또는 비밀번호를 확인해주세요.');
        Auth::login($user);

        return redirect('/')->with('msg','로그인이 완료되었습니다.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('msg','로그아웃이 완료되었습니다.');
    }
}
