<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $email = '805314698@qq.com';
        $user = Db::table('user_login')->where('email',$email)->first();
        return view('user.index',compact('user'));
    }
    public function login()
    {
        return view('user.login');
    }
    public function register()
    {
        return view('user.register');
    }
    public function dologin(Request $request)
    {
        $condition = [];
        // 获取表单数据
        $condition['email'] = $request->input('email');
        $condition['password'] = $request->input('password');
        // 获取匹配记录
        $user = DB::table('user_login')->where($condition)->find();
        if ($user) {    // 登录成功
            // 写入session
            session('users', $user->email);
            return redirect('/user');
        } else {
            return redirect()->back()->withInput();
        }
    }

}
