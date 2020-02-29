<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        echo 'hello word';
    }

    public function add(){
        //echo '添加用户';
        return view('user.add');
    }

    public function adddo(Request $request){
       $data=$request->all();
       dd($data);
    }
    
   public function cartgoty(){
       $sid='服装';
       return view('user.cartgoty',['sid'=>$sid]);
   }
   
   
    //添加页面
    public function brand(){
        return view('user.brand');
    }

   

}
