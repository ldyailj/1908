<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Shop;
use App\Cate;
use App\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        /**分类数据*/
        $cateinfo=Cate::all()->toArray();
        $cateinfo= cateinfo($cateinfo);
        /**品牌数据*/
        $pageSize=config('app.pageSize'); //页数
        $brandinfo=Brand::all();
        $info=Shop::leftjoin('cate','shop.cate_id','=','cate.cate_id',)
            ->leftjoin('brand','shop.b_id','=','brand.b_id')
            ->paginate($pageSize);
    
        foreach($info as $k=>$v){
            // if( !$v->shop_file) continue;
            $info[$k]['shop_file']=explode('|',$v['shop_file']);
        }
     
       return view('shop/index',['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类
        $cateinfo=Cate::all()->toArray();

        $cateinfo=cateinfo($cateinfo);//调用方法
       //品牌
        $brandinfo=Brand::all();
        return view('shop.create',['cateinfo'=>$cateinfo,'brandinfo'=>$brandinfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');

        //商品货号
        $data['shop_art']=$this->CreateShopart();
        
        $data=$request->except('_token');
        //单文件上传
        if($request->hasFile('shop_img')){
            $data['shop_img']=upload('shop_img');
            // dd($data);die;
        }
        //多文件上传
        if(isset($data['shop_file'])){
            $photos=Moreuploads('shop_file');
            $data['shop_file']=implode('|', $photos);
            // dd($data);die;
        }
        $res=Shop::create($data);
        if($res){
            return redirect('/shop');
        }
     }

     //产生货号
     public function CreateShopart(){
        return 'shop'.date('YmdHis').rand(1000,9999);
     }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //分类
        $cateinfo=Cate::all()->toArray();
        $cateinfo=cateinfo($cateinfo);//调用方法
       //品牌
        $brandinfo=Brand::all();

        $data=Shop::where(['shop_id'=>$id])->first(); 
        // dd($data);
        return view('shop.edit',['data'=>$data,'cateinfo'=>$cateinfo,'brandinfo'=>$brandinfo]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');

        if($request->hasFile('shop')){
            $data['shop']= $this->upload('shop');
        }
        $res =Shop::where(['shop_id'=>$id])->update($data);
        if($res!==false){
            return redirect('/shop');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Shop::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
            
        }
    }

}
