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
<center><h2>品牌修改</h2></center>

<form  action="{{url('/ping/update/'.$user->sid)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" value="{{$user->sname}}" name="sname" class="form-control" id="firstname" placeholder="请输入品牌名称">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <input type="file" name="stp">
            <img src="{{env('UPLOAD_URL')}}{{$user->stp}}"width="30" height="30">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" value="{{$user->swz}}" name="swz" class="form-control" id="lastname" placeholder="请输入品牌网址">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
        <textarea name="sms"class="form-control" id="lastname" placeholder="请输入品牌描述">{{$user->sms}}</textarea>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">品牌修改</button>
        </div>
    </div>
</form>

</body>
</html>