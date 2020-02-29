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
<center><h2>管理员添加</h2></center>

<form  action="{{url('/admins/update/'.$data->g_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员名称</label>
        <div class="col-sm-10">
            <input type="text" name="g_name" value="{{$data->g_name}}" class="form-control" id="firstname">
            <b style="color:red">
                {{$errors->first('g_name')}} 
            </b>
        </div>
    </div>

      <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
           <input type="password" name="g_pwd" value="{{$data->g_pwd}}" class="form-control" id="firstname">
           <b style="color:red">
                {{$errors->first('g_pwd')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
           <input type="password" name="g_pwds" value="{{$data->g_pwds}}" class="form-control" id="firstname">
           <b style="color:red">
                {{$errors->first('g_pwds')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">管理员头像</label>
        <div class="col-sm-10">
            <input type="file" name="g_img">
            <img src="{{env('UPLOAD_URL')}}{{$data->g_img}}" width="30" height="30">
        </div>
    </div>

       <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-10">
           <input type="text" name="g_tel" value="{{$data->g_tel}}" class="form-control" id="firstname">
           <b style="color:red">
                {{$errors->first('g_tel')}} 
            </b>
        </div>
    </div>

       <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
           <input type="text" name="g_email" value="{{$data->g_email}}" class="form-control" id="firstname">
           <b style="color:red">
                {{$errors->first('g_email')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>