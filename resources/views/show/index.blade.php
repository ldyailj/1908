<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>Document</title>
 </head>
 <body>
    <table border>
        <thead>
        <tr>
            <th>分类名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $k=>$v)
        <tr>
            <td>{!! str_repeat('&nbsp;&nbsp;',$v['level']*3)!!}{{$v['sname']}}</td>
            <td>
                <a href="{{url('show/edit/'.$v['sid'])}}">修改</a>
                <a href="javascript:void(0)" onclick="del({{$v['sid']}})">删除</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>     
<script src="/static/js/jquery.min.js"></script>
    <script>
        function del(id){
            if(!id){
                return;
            }
       
        if(confirm('是否确认删除')){
            //ajax删除
            $.get('/show/destroy/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json')
        }
     } 
    </script>
 