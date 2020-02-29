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
    <form action="{{url('/wz/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>文章标题</td>
                <td>
                  <input type="text" name="sname">
                  <b style="color:red">{{$errors->first('sname')}}</b>
               </td>
            </tr>
            <tr>
                <td>文章分类</td>
                <td>
                    <select name="bid">
                            <option value="">--请选择--</option>
                            @foreach($classinfo as $k=>$v)
                            <option value="{{$v->bid}}">{{$v->bname}}</option>
                             @endforeach
                        </select>
                </td>
            </tr>
            <tr>
                <td>文章重要性</td>
                <td>
                    <input type="radio" name="szyx" value="1" checked>普通
                     <input type="radio" name="szyx" value="2">置顶
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="sxs" value="1" checked>显示
                    <input type="radio" name="sxs" value="2">不显示
                </td>
            </tr>
            <tr>
                <td>文章作者</td>
                <td>
                  <input type="text" name="szz">
                  <b style="color:red">{{$errors->first('szz')}}</b>
                </td>
            </tr>
            <tr>
                <td>作者email</td>
                <td><input type="text" name="semail">
                <b style="color:red">
                     {{$errors->first('semail')}} 
                 </b></td>
            </tr>
            <tr>
                <td>关键字</td>
                <td><input type="text" name="sgjz">
                <b style="color:red">
                     {{$errors->first('sgjz')}} 
                 </b></td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td><textarea name="sms"></textarea>
                <b style="color:red">
                     {{$errors->first('sms')}} 
                 </b></td>
            </tr>
            <tr>
                <td>上传文件</td>
                <td><input type="file" name="simg"></td>
            </tr>
            <tr>
                <td><input type="button" value="添加"></td>
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


        //验证唯一性
        $.ajax({
            type:"post",
            url:"/wz/checkOnly",
            data:{sname:sname},
            async:false,
            dataType:'json',
            success:function(result){
                if(result.count>0){
                    $('input[name="sname"]').next().html("标题已存在");
                    titleflag=false;
                }
        }
        });
        if(titleflag==false){
            return;
        }
       
        //作者验证
        var szz = $("input[name='szz']").val();
        var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/
        if(szz==''){
            $("input[name='szz']").next().html('作者不能为空');
            return 
        }
        if(!reg.test(szz)){
        titleflag=false      
        $("input[name='szz']").next().html('作者由文字母数字组成');
        // alert('ok');
        }
        //form 提交
        if(titleflag==false){
                alert('无法提交');
                return 
        }else{
                $('form').submit();
                 return;
        }
      
    });


    $("input[name='szz']").blur(function(){
        $(this).next().html('');
        var szz=$(this).val();
        var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        // alert(reg.test(szz));
        if(!reg.test(szz)){
        $(this.next().html('作者由文字母数字组成切不能为空'));
        return;
        }
    })


   $(document).on('blur','input[name="sname"]',function(){
        $(this).next().html('');
        var sname=$(this).val();
        var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        if(!reg.test(sname)){
            $(this).next().html('文章标题由文字母数字组成切不能为空');
            return;
        }

    //验证唯一性
    $.ajax({
        type:"post",
        url:"/wz/checkOnly",
        data:{sname:sname},
        //async:true,
        dataType:'json',
        success:function(result){
            // console.log(result);return;
            if(result.count>0){
                $('input[name="sname"]').next().html("标题已存在");
            }
    }});


 })
</script>