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
<center><h2>展示页面</h2></center>
   <form>
        <input type="text" name="sname" value="{{$sname}}" placeholder="请输入学生姓名">
        <input type="submit" value="搜索">
    </form>
    <table class="table">
        <caption></caption>
        <thead>
        <tr>
            <th>id</th>
            <th>名字</th>
            <th>头像</th>
            <th>性别</th>
            <th>班级</th>
            <th>成绩</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->sid}}</td>
            <td>{{$v->sname}}</td>
            <td>@if($v->stp)<img src="{{env('UPLOAD_URL')}}{{$v->stp}}" width="30" height="30">@endif</td>
            <td>{{$v->is_hubei==1?'男':'女'}}</td>
            <td>{{$v->sbj}}</td>
            <td>{{$v->scj}}</td>
            <td>
                <a href="{{url('ban/edit/'.$v->sid)}}" class="btn btn-info">修改</a>
                <a href="{{url('ban/destroy/'.$v->sid)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
             <tr>
                 <td colspan='7'>{{$data->appends(['sname'=>$sname])->links()}}</td>
             </tr>
        </tbody>
    </table>
</body>
</html>