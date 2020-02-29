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
<center><h2>品牌列表</h2></center>
    <table class="table">
        <caption></caption>
        <thead>
        <tr>
            <th>id</th>
            <th>品牌名称</th>
            <th>品牌LOGO</th>
            <th>品牌网址</th>
            <th>品牌描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->sid}}</td>
            <td>{{$v->sname}}</td>
            <td>@if($v->stp)<img src="{{env('UPLOAD_URL')}}{{$v->stp}}" width="30" height="30">@endif</td>
            <td>{{$v->swz}}</td>
            <td>{{$v->sms}}</td>
            <td>
                <a href="{{url('ping/edit/'.$v->sid)}}" class="btn btn-info">修改</a>
                <a href="{{url('ping/destroy/'.$v->sid)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>