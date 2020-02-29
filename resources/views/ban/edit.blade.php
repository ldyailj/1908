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
<center><h2>学生修改</h2></center>

<form  action="{{url('/ban/update/'.$user->sid)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
            <input type="text" value="{{$user->sname}}" name="sname" class="form-control" id="firstname" placeholder="请输入名字">
               <b style="color:red">
                {{$errors->first('sname')}} 
            </b>
        </div>
    </div>

     <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" name="stp">
            <img src="{{env('UPLOAD_URL')}}{{$user->stp}}"width="30" height="30">
        </div>
    </div>

    <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">性别</label>
    <div class="radio">
        <label>
            <input type="radio" name="is_hubei" id="optionsRadios1" 
            value="1" @if($user->is_hubei==1) checked @endif>男
        </label>

        <label>
            <input type="radio" name="is_hubei" id="optionsRadios1" 
            value="2" @if($user->is_hubei==2) checked @endif>女
        </label>
    </div>
        </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">班级</label>
        <div class="col-sm-10">
            <input type="text" value="{{$user->sbj}}" name="sbj" class="form-control" id="lastname" placeholder="请输入班级">
             <b style="color:red">
                {{$errors->first('sbj')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">成绩</label>
        <div class="col-sm-10">
            <input type="text" value="{{$user->scj}}" name="scj" class="form-control" id="lastname" placeholder="请输入成绩">
             <b style="color:red">
                {{$errors->first('scj')}} 
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