<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
  <meta name="csrf-token" content="{{csrf_token()}}">
 </head>
 <body>
    <form action="{{url('/wz/update/'.$info->sid)}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>文章标题</td>
                <td><input type="text" name="sname"  value="{{$info->sname}}" >
                <b style="color:red">{{$errors->first('sname')}}</b>
                </td>
            </tr>
            <tr>
                <td>文章分类</td>
                <td>
                    <select name="bid">
                            <option>--请选择--</option>
                            @foreach($classinfo as $k=>$v)
                            <option value="{{$v->bid}}">{{$v->bname}}</option>
                             @endforeach
                        </select>
                </td>
            </tr>
            <tr>
                <td>文章重要性</td>
                <td>
                    <input type="radio" name="szyx" value="1" @if($info->szyx==1) checked @endif>普通
                    <input type="radio" name="szyx" value="2" @if($info->szyx==2) checked @endif>置顶
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="sxs" value="1" @if($info->sxs==1) checked @endif>显示
                    <input type="radio" name="sxs" value="2" @if($info->sxs==2) checked @endif>不显示
                </td>
            </tr>
            <tr>
                <td>文章作者</td>
                <td><input type="text" name="szz" value="{{$info->szz}}"></td>
            </tr>
            <tr>
                <td>作者email</td>
                <td><input type="text" name="semail" value="{{$info->semail}}"></td>
            </tr>
            <tr>
                <td>关键字</td>
                <td><input type="text" name="sgjz" value="{{$info->sgjz}}"></td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td><textarea name="sms">{{$info->sms}}</textarea></td>
            </tr>
            <tr>
                <td>上传文件</td>
                <td>
                    <input type="file" name="simg">
                    <img src="{{env('UPLOAD_URL')}}{{$info->simg}}"width="30" height="30">
                </td>
            </tr>
            <tr>
                <td><input  type="button" value="修改"></td>
                <td></td>
            </tr>
        </table>
    </form>
 </body>
</html>

<script src="/static/js/jquery.min.js"></script>
<script>
 // ajax令牌
 $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
   
     var  sid={{$info->sid}};
    $("input[type='button']").click(function(){
        var titleflag=true;
        $('input[name="sname"]').next().html('');
        //标题验证
        // alert(123);
        var sname=$('input[name="sname"]').val();
        var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        if(!reg.test(sname)){
        $('input[name="sname"]').next().html('文章标题由文字母数字组成切不能为空'); 
        return;
        }
    
       //alert(sid); //获取主键ID的值

        //验证唯一性
        $.ajax({
            url:"/wz/checkOnly",
            data:{sname:sname,sid:sid},
            type:"post",
            async:false,
            dataType:'json',
            success:function(result){
                console.log(result)
                // if(result.count>0){
                //     $('input[name="sname"]').next().html("标题已存在");
                //     titleflag=false;
                // }
        }
        })
        // if(titleflag==false){
        //     return;
        // }
       
        // //作者验证
        // var szz = $("input[name='szz']").val();
        // var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/
        // if(szz==''){
        //     $("input[name='szz']").next().html('作者不能为空');
        //     return 
        // }
        // if(!reg.test(szz)){
        // titleflag=false      
        // $("input[name='szz']").next().html('作者由文字母数字组成');
        // // alert('ok');
        // }
        // //form 提交
        // if(titleflag==false){
        //         alert('无法提交');
        //         return 
        // }else{
        //         $('form').submit();
        //          return;
        // }
      
});
</script>