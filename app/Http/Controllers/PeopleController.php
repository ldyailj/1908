<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //搜索
        $username = request()->username??'';
        $where=[];
        if($username){
            $where[]=['username','like',"%$username%"];
        }

        //DB操作
        // $data=Db::table('people')->select('*')->get();

        //ORM操作
        // $data=People::get();
        
        //分页
        $pageSize =config('app.pageSize');
        // echo $pageSize;die;
        $data=People::where($where)->orderby('p_id','desc')->paginate($pageSize);

       return view('people.index',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
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

    public function store(Request $request)
                //第二种验证
    // public function store(StorePeoplePost $request)
    {
        //第一种验证 validate
        // $request->validate([
        //     'username'=>'required|unique:people|max:12|min:2',
        //     'age'=>'required|integer|min:1||between:1,130',
        // ],[
        //     'username.required'=>'名字不能为空',
        //     'username.unique'=>'名字已存在',
        //     'username.max'=>'名字长度不超过12位',
        //     'username.min'=>'名字长度不少于2位',
        //     'age.required'=>'年龄不能为空',
        //     'age.integer'=>'年龄必须为数字',
        //     'age.min'=>'年龄数据不合法',
        //     'age.required'=>'年龄数据不合法',
        // ]);

        $data=$request->except('_token');

        //第三种验证
        $validator = validator::make($request->all(),[
            'username'=>'required|unique:people|max:12|min:2',
            'age'=>'required|integer|min:1|between:1,130',
        ],[
                'username.required'=>'名字不能为空',
                'username.unique'=>'名字已存在',
                'username.max'=>'名字长度不超过12位',
                'username.min'=>'名字长度不少于2位',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄必须为数字',
                'age.min'=>'年龄数据不合法',
                'age.required'=>'年龄数据不合法',
        ]);
        if($validator->fails()){
            return redirect('people/create')
            ->withErrors($validator)
            ->withInput();
        }

        //判断有无文件上传
        if($request->hasFile('head')){
            $data['head']= $this->upload('head');
        }
        $data['add_time']=time();

        // DB操作
        // $res=DB::table('people')->insert($data);

        //ORM操作  save
        // $people=new People;
        // $people->username = $data['username'];
        // $people->age = $data['age'];
        // $people->card = $data['card'];
        // $people->head = $data['head'];
        // $people->add_time = $data['add_time'];
        // $res=$people->save();

        //ORM操作 create
        //  $res =People::create($data);

        //ORM操作 insert
        $res=People::insert($data);

        if($res){
            return redirect('/people');
        }
        //dd($res);

    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //DB操作
        // $user =DB::table('people')->where('p_id',$id)->first();

        // $user= People::where('p_id',$id)->first();

        //ORM操作 
        $user= People::find($id);
    
        // dd($user);
        return view('people.edit',['user'=>$user]);
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

        if($request->hasFile('head')){
            $user['head']= $this->upload('head');
        }
        //DB操作
        // $res=DB::table('people')->where('p_id',$id)->update($user);

        //ORM 操作
        $res =People::where('p_id',$id)->update($user);



        if($res!==false){
            return redirect('/people');
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
        //DB操作
        // $res =DB::table('people')->where('p_id',$id)->delete();

        //ORM 操作
        $res=People::destroy($id);

        if($res){
            return redirect('/people');
        }

    }
}
