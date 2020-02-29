    @extends('layouts.shop')

    @section('title', '注册页')
    @section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/regdo')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_account" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text"  name="email" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="text" name="u_pwd"  placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="u_pwd2" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
    

     <!-- <script>
        $('button').click(function(){
           // alert(123);
           var u_account = $('input[name="u_account"]').val(); 
            if(!u_account){
                alert('请输入手机号或者邮箱！');
                return;
            }
            $.get('/send',{u_account:u_account},function(result){
                alert(result);
                // if(code=='0000'){
                //     alert('发送成功');
                // }
            //   },'json');
            });
        });
     </script>   -->
      @endsection