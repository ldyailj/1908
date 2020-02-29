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
      <form  action="{{url('/show/update/'.$user->sid)}}" method="post">
        @csrf
            <table border>
                <tr>
                    <td>分类名称</td>
                    <td>
                         <input type="text" name="sname" value="{{$user->sname}}">
                         <b style="color:red">{{$errors->first('sname')}}</b>
                    </td>
                </tr>
                <tr>
                    <td>分类</td>
                    <td>
                            <select name="pid">
                                 <option value="0">--请选择--</option>
                                   @foreach($data as $k=>$v)
                                  <option value="{{$v['sid']}}">{!! str_repeat('&nbsp;&nbsp;',$v['level']*3)!!}{{$v['sname']}}</option>
                                   @endforeach
                            </select>                     
                    </td>
                </tr>
                <tr>
                    <td>分类介绍</td>
                    <td> <textarea name="sdescribe">{{$user->sdescribe}}</textarea></td>
                </tr>
                <tr>
                    <td><button type="submit">修改</button></td>
                    <td></td>
                </tr>
            </table>
      </form>
 </body>
</html>
