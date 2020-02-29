<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests\StoreBanPost;
use Illuminate\Validation\Rule;
class banController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $sname = request()->sname??'';
        $where=[];
        if($sname){
            $where[]=['sname','like',"%$sname%"];
        }
        
        $pageSize =config('app.pageSize');
        $data=Db::table('ban')->where($where)->orderby('sid','desc')->paginate($pageSize);
        return view('ban.index',['data'=>$data,'sname'=>$sname]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ban.create');
       
    }

      /**分装 文件上传
     * $feilename 文件域的名字
     */
    public function upload($filename){
        //判断上传过程有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo =request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }


    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
     public function store(StorebanPost $request)
    {
        $data=$request->except('_token');

         $validator = validator::make($data,[
            'sname'=>['required','unique:ban','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}$/u'],
            // 'sname'=>'required|unique:ban','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u/',
            'sbj'=>'required',
            'scj'=>'required|between:0,100',
        ],[
               'sname.required'=>'名字不能为空',
                'sname.unique'=>'名字已存在',
                'sname.regex'=>'必须是中文、字母、下划线、数字组成、2,12位之前',
                'sbj.required'=>'班级不能为空',
                'scj.required'=>'成绩不能为空',
                'scj.max'=>'不超过100位',
        ]);
        if($validator->fails()){
            return redirect('ban/create')
            ->withErrors($validator)
            ->withInput();
        }
        //判断有无文件上传
        if($request->hasFile('stp')){
            $data['stp']= $this->upload('stp');
        }

        $res=DB::table('ban')->insert($data);
        if($res){
            return redirect('/ban');
        }
    }

    /**
     * Display the specified resource.
     *预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =DB::table('ban')->where('sid',$id)->first();
        // dd($user);
        return view('ban.edit',['user'=>$user]);
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

         $validator = validator::make($user,[
             'sname'=>['required',Rule::unique('ban')->ignore($request->id,'sid'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'],
            // 'sname'=>'required|unique:ban','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u/',
            'sbj'=>'required',
            'scj'=>'required|between:0,100',
        ],[
               'sname.required'=>'名字不能为空',
                'sname.unique'=>'名字已存在',
                'sname.regex'=>'必须是中文、字母、下划线、数字组成、2,12位之前',
                'sbj.required'=>'班级不能为空',
                'scj.required'=>'成绩不能为空',
                'scj.max'=>'不超过100位',
        ]);

         if($request->hasFile('stp')){
            $user['stp']= $this->upload('stp');
        }

         if($validator->fails()){
            return redirect('ban/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $res=DB::table('ban')->where('sid',$id)->update($user);
        if($res!==false){
            return redirect('/ban');
        }
        // dd($res);
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res =DB::table('ban')->where('sid',$id)->delete();
        if($res){
            return redirect('/ban');
        }
    }
}
