<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop;
use App\Brand;
use App\Cate;

class ProController extends Controller
{
    public function prolist($id=''){
//        $b_id=request()->b_id;
        $where=[];
        if($id){
            $where[]=['b_id','=',$id];
        }
        $shop_name=request()->shop_name;
        if($shop_name){
            $where[]=['shop_name','like','%'.$shop_name.'%'];
        }
        $ShopListPag=config('app.ShopListPag');
        $shopinfo=Shop::where($where)->paginate($ShopListPag);
        return view('pro.prolist',['shopinfo'=>$shopinfo,'shop_name'=>$shop_name]);
    }

    public function proinfo($id){
        $shopinfo=Shop::where(['shop_id'=>$id])->first();
        return view('pro.proinfo',['shopinfo'=>$shopinfo]);
    }


}
