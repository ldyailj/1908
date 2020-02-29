<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员展示</h2></center>
     <form>
        <input type="text" name="g_name" value="{{$g_name}}" placeholder="请输管理员名称">
        <input type="submit" value="搜索">
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>管理员名称</th>
            <th>商品图片</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->g_id}}</td>
            <td>{{$v->g_name}}</td>
            <td>@if($v->g_img)<img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" width="30" height="30">@endif</td>
            <td>{{$v->g_tel}}</td>
            <td>{{$v->g_email}}</td>
            <td>
                <a href="{{url('admins/edit/'.$v->g_id)}}" class="btn btn-info">修改</a>
                 <a href="javascript:void(0)" onclick="del({{$v['g_id']}})">删除</a>
            </td>
        </tr>
        @endforeach
             <tr>
                 <td colspan='7'>{{$data->links()}}</td>
             </tr>
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
            $.get('/admins/destroy/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json')
        }
     } 
    </script>
