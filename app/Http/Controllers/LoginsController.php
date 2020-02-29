<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class LoginsController extends Controller
{
    public function logindo(Request $request){
        $post=$request->except('_token');
    //    echo encrypt(123456);die;
        // dd($post);

        $admin=Admin::where(['admin_name'=>$post['admin_name']])->first();
                                // echo decrypt($admin->pwd);die; //检查密码是否解析成功
        if(!$admin){
            return redirect('/login/create')->with('msg','该用户不存在！');
        }

        if($post['admin_pwd']!=decrypt($admin['admin_pwd'])){
            return redirect('/login/create')->with('msg','密码错误！');
            
        }
        session(['adminuser'=>$admin]);
        $request->session()->save();
        return redirect('/cate');
    }
}