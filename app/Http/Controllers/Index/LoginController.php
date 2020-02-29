<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Index\User;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

use App\Member;
//发送邮件
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //登录
    public function logindo(){
        $data=request()->except('_token');
        dd($data);die;
        $userinfo=User::where(['u_account'=>$data['u_account']])->first();
        if(decrypt($userinfo['u_pwd'])==$data['u_pwd']){
            session(['user'=>$userinfo]);
            request()->session()->save();
            return redirect('/');
        }else{
            return redirect('/login')->with('error','登录失败请重试');
        }

    }

    //注册
    public function reg(){
        return view('index.reg');
    }
    public function regdo(){
        $data=request()->except('_token');
        // dd($data);die;
    
        // //判断验证码
        // $code=session('code');
        // if($code!=$data['code']){
        //     return redirect('/reg')->with('msg','您输入的验证码不对');
        // }

        //密码和确认密码是否一致
        if($data['u_pwd']!=$data['u_pwd']){
            return redirect('/reg')->with('msg','密码不一致');
        }
        unset($data['u_pwd2']);
        unset($data['email']);

        $data['add_time']=time();
        $res=User::create($data);
        // dd($res);die;
        if($res){
            return redirect('/login')->with('success','注册成功');
        }
        return redirect('/reg')->with('error','注册失败');
    }
/*
    //发送邮件
    public function sendEmail(){
        $email = '2356911868@qq.com';
        Mail::to($email)->send(new sendCode());
    }


    //短信
    public function ajaxsend(){
    	//接受注册页面的手机号
    	//$moblie = '13754431522';
    	$moblie = request()->mobile;
    	$code = rand(1000,9999);
    	$res = $this->sendSms($moblie,$code);
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();
    		echo "发送成功";
    	}
    }
    //短信
    public function sendSms($moblie,$code){
        AlibabaCloud::accessKeyClient('LTAI4FceRV4YytBvL1iprB2D', 'ye93gQXSV7eMl3QptYUA2ESqMsrEBu')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => "$moblie",
                                                'SignName' => "轼爱",
                                                'TemplateCode' => "SMS_181866176",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage();
        } catch (ServerException $e) {
            return $e->getErrorMessage();
        }

    }
        
*/


}
