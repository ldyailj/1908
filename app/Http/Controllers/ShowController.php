<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Show;
use App\Http\Requests\StoreShowPost;
use Illuminate\Validation\Rule;
use Validator;
class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $res=Show::all()->toArray();
        $data=$this->CreateTree($res);
        // print_r($data);die;
        return view('Show.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data=Show::all()->toArray();
         // $data= Show::get();
        // dump($data);
         $data=$this->CreateTree($data);
        //ss dd($data);
        return view('show.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data=$request->except('_token');
      
         $validator=Validator::make($data,[
            'sname'=>['required','unique:show','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}$/u'],

        ],[
            'sname.required'=>'不能为空',
            'sname.unique'=>'已存在',
            'sname.regex'=>'必须是中文,字母，下划线，数字组成且2,12位',
        ]);
        if ($validator->fails())
        {
            return redirect('show/create')
                ->withErrors($validator)
                ->withInput();
        }


        
        $res=Show::insert($data);
        if($res){
            return redirect('show/index');
        }
    }

    /**无限极  */
    public function CreateTree($info,$pid=0,$level=1){
        static $res=[];
        foreach($info as $k=>$v){
        if($v['pid']==$pid){
            $v['level']=$level;
            $res[]=$v;
            $this->CreateTree($info,$v['sid'],$v['level']+1);
            }
        }
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Show::all()->toArray();
        $data=$this->CreateTree($data);
        $user= Show::find($id);
        return view('show.edit',['user'=>$user,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑页面
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=$request->except('_token');

       
       // if($request->hasFile('show')){
       //      $user['show']= $this->upload('show');
       //  }

         $validator=Validator::make($user,[
            'sname'=>['required',Rule::unique('show')
            ->ignore($request->id,'sid'),
            'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'], 
        ],[
            'sname.required'=>'不能为空',
            'sname.unique'=>'已存在',
            'sname.regex'=>'必须是中文,字母，下划线，数字组成且2,12位',
        ]);
        if ($validator->fails())
        {
            return redirect("show/edit/".$id)
                ->withErrors($validator)
                ->withInput();
        }

        $res =Show::where('sid',$id)->update($user);
        if($res!==false){
            return redirect('/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Show::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}