<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Admins;
use Illuminate\Validation\Rule;
class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $g_name = request()->g_name??'';
        $where=[];
        if($g_name){
            $where[]=['g_name','like',"%$g_name%"];
        }
        $pageSize =config('app.pageSize');
        $data=Admins::where($where)->paginate($pageSize);
        // $data=Db::table('ban')->where($where)->orderby('sid','desc')->
        return view('/Admins/index',['data'=>$data,'g_name'=>$g_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admins.create');
        
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
       // dd($data);die;
       if ($data['g_pwd']!==$data['g_pwds']) {
            return redirect('admins/create')->with('msg','密码有误');
       }                  



           $validator = validator::make($data,[
            'g_name'=>'required|unique:admins',
            'g_pwd'=>'required',
            'g_pwds'=>'required',
            'g_tel'=>'required',
            'g_email'=>'required',
        ],[
                'g_name.required'=>'不能为空',
                'g_name.unique'=>'已存在',
                'g_pwd.required'=>'密码不能为空',
                'g_pwds.required'=>'确认密码不能为空',
                'g_tel.required'=>'手机号不能为空',
                'g_email.required'=>'邮箱不能为空',               
        ]);
        if($validator->fails()){
            return redirect('admins/create')
            ->withErrors($validator)
            ->withInput();
        }
       if($request->hasFile('g_img')){
            $data['g_img']=upload('g_img');
            //dd($data);die;
        }
        $res=Admins::create($data);
        if($res){
            return redirect('/admins');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Admins::where(['g_id'=>$id])->first();
        return view('/admins/edit',['data'=>$data]);
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

          $validator = validator::make($data,[
            'g_name'=>'required','unique:admins',Rule::unique('admins')->ignore($request->id,'g_id'),
            'g_pwd'=>'required',
            'g_pwds'=>'required',
            'g_tel'=>'required',
            'g_email'=>'required',
        ],[
                'g_name.required'=>'不能为空',
                'g_name.unique'=>'已存在',
                'g_pwd.required'=>'密码不能为空',
                'g_pwds.required'=>'确认密码不能为空',
                'g_tel.required'=>'手机号不能为空',
                'g_email.required'=>'邮箱不能为空',               
        ]);
        if($request->hasFile('admins')){
            $data['admins']= $this->upload('admins');
        }

          if($validator->fails()){
            return redirect('admins/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $res =Admins::where(['g_id'=>$id])->update($data);
        if($res!==false){
            return redirect('/admins');
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
       $res=Admins::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
            
        }
    }
}
