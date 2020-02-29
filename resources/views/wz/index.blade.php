<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
      <form>
        <input type="text" name="sname" value="{{$sname}}" placeholder="请输入文章标题">
         <select name="bid">
                            <option>--请选择--</option>
                            @foreach($classinfo as $k=>$v)
                            <option value="{{$v->bid}}">{{$v->bname}}</option>
                             @endforeach
                        </select>
        <input type="submit" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>id</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>文章作者</td>
            <td>作者email</td>
            <td>关键字</td>
            <td>网页描述</td>
            <td>上传文件</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
            @foreach($info as $k=>$v)
        <tr sid="{$v->sid}">
            <td>{{$v->sid}}</td>
            <td>{{$v->sname}}</td>
            <td>{{$v->bname}}</td>
            <td>{{$v->szyx}}</td>
            <td>{{$v->sxs==1?'√':'×'}}</td>
            <td>{{$v->szz}}</td>
            <td>{{$v->semail}}</td>
            <td>{{$v->sgjz}}</td>
            <td>{{$v->sms}}</td>
            <td>@if($v->simg)<img src="{{env('UPLOAD_URL')}}{{$v->simg}}" width="30" height="30">@endif</td>
            <td>{{date('y-m-d h:i:s',$v->stime)}}</td>
            <td>
                <a href="{{url('wz/edit/'.$v->sid)}}">修改</a>
               <!-- <a href="{{url('wz/destroy/'.$v->sid)}}">删除</a> -->
                <a href="javascript:void(0)" onclick="del({{$v->sid}})">删除</a>

            </td>
        </tr>
        @endforeach
            <tr>
                 <td>{{$info->appends(['sname'=>$sname])->links()}}</td>
             </tr>


<script src="/static/js/jquery.min.js"></script>
    <script>
        function del(id){
            if(!id){
                return;
            }
       
        if(confirm('是否确认删除')){
            //ajax删除
            $.get('/wz/destroy/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json')
        }
     } 
    </script>
  </body>            
</html>