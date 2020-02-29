<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Wz;
use App\Http\Requests\StoreWzPost;
use Illuminate\Validation\Rule;
use Validator;
class WzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sname=request()->sname??'';
        $bid=request()->bid??'';
        $where=[];
        if($sname){
            $where[]=['sname','like',"%$sname%"];
        }
        if($bid){
            $where[]=['wz_do.bid','=',$bid];
        }

        $classinfo= DB::table('wz_do')->get();
        $page=config('app.pageSize');
        $info=DB::table('wz')->leftjoin('wz_do','wz.bid','=','wz_do.bid')->where($where)->paginate($page);
        return view('/wz/index',['info'=>$info,'classinfo'=>$classinfo,'sname'=>$sname,'bid'=>$bid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classinfo= DB::table('wz_do')->get();
        // dd($classinfo);die;
        return view('wz.create',['classinfo'=>$classinfo]);
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
            'sname'=>['required','unique:wz','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}$/u'],
            'szz'=>'required',
            'semail'=>'required',
            'sgjz'=>'required',
            'sms'=>'required',
        ],[
            'sname.required'=>'文章必填',
            'sname.unique'=>'文章已存在',
            'sname.regex'=>'必须是中文,字母，下划线，数字组成且2,12位',
            'szz.required'=>'作者标题',
            'semail.required'=>'作者email必填',
            'sgjz.required'=>'关键字必填',
            'sms.required'=>'网页描述必填',
        ]);
        if ($validator->fails())
        {
            return redirect('wz/create')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('simg')){
            $data['simg']=$this->upload('simg');
        }
        $data['stime']=time();
        $info=DB::table('wz')->insert($data);
        
        if($info){
            return redirect('/wz');
        }
    }
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = request()->file($filename);
            $store_result = $photo->store($filename);
            return $store_result;
        }
        exit('为获取到上传文件或上传文件出错');
    }

    //ajax 唯一性验证
    public function checkOnly(){
        $sname=request()->sname;
        $where=[];
        if($sname){
            $where[] = ['sname','=',$sname]; 
        }
        //排除自身
        $sid = request()->sid;
        // echo $sid;exit;
        if($sid){
            $where[]=['sid','!=',$sid];
        }
        // echo $sid;die;
        $count=Wz::where($where)->count();
        // dd($count);exit;
        // $count=Db::table('wz')->where('sname','=',$title)->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classinfo= DB::table('wz_do')->get();
        $info=DB::table('wz')->where('sid',$id)->first();
       return view('/wz/edit',['classinfo'=>$classinfo,'info'=>$info]);
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
        $validator=Validator::make($data,[
            'sname'=>['required',Rule::unique('wz')
            ->ignore($request->id,'sid'),
            'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'],

            'szz'=>'required',
            'semail'=>'required',
            'sgjz'=>'required',
            'sms'=>'required',
        
        ],[
            'sname.required'=>'文章必填',
            'sname.unique'=>'文章已存在',
            'sname.regex'=>'必须是中文,字母，下划线，数字组成且2,12位',
            'szz.required'=>'作者标题',
            'semail.required'=>'作者email必填',
            'sgjz.required'=>'关键字必填',
            'sms.required'=>'网页描述必填',
        ]);
        if ($validator->fails())
        {
            return redirect("wz/edit/".$id)
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasFile('simg')){
        $data['simg']=$this->upload('simg');
        }

        $res=DB::table('wz')->where('sid',$id)->update($data);
        if($res!==false){
         return redirect('/wz');
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
        //  $res=DB::table('wz')->where('sid',$id)->delete();
         $res=Wz::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
            // return redirect('/wz');
        }
    }
}
