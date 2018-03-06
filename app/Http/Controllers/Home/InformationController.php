<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CheckPwd;
use Mail;


class InformationController extends Controller
{
    /**
     * 显示个人页面
     *
     * @return view index
     */

    public function index() 
    {
        return view('Home.Person.person');
    }

    /**
     * 显示个人信息页面
     *
     * @return view information
     */

    public function information() 
    {
        //!查存在session里存进去的用户id.
        //!where语句的id应该从session里取出来
        $uid = session('homeUser')->id;
        $userinfo = DB::table('shop_home_user')->select('id', 'username', 'phone', 'email', 'sex', 'pic')->where('id', $uid)->first();

        return view('Home.Person.information',['userinfo'=>$userinfo]);
    }

    /**
     * 修改个人图片
     *
     * @return view information, msg
     */
    public function alterPic(Request $request) 
    {   
        if ($request->hasFile('file')) {

            $path = $request->file('file')->store('public');

            $newPic = ltrim($path, 'public/');

            if($path) {

                //查找原来的pic字段,如果不是默认图片,那么删除图片
                $uid = session('homeUser')->id;
                $oldPic = DB::table('shop_home_user')->where('id', $uid)->value('pic');

                if ($oldPic == 'default.jpg') {

                    //更新这个用户数据库pic的字段
                    DB::table('shop_home_user')->where('id', $uid)->update(['pic'=>$newPic]);                 
                } else {
                    //更新这个用户数据库pic的字段
                    DB::table('shop_home_user')->where('id', $uid)->update(['pic'=>$newPic]);
                    //删除图片
                    Storage::delete('public/'.$oldPic);
                }
             
                 

            }

            return back()->with('msg', '上传成功');
            
        } else {
            //没有图片上传,就返回提示信息
            return back()->with('errormsg', '没有图片上传,请选择图片');

        }
    }


    /**
     * 显示安全设置页面
     * 
     * @return view safety,phone 135*****234, email 821****@qq.com
     */
    public function safety() 
    {
        $uid = session('homeUser')->id;

        $userinfo = DB::table('shop_home_user')->select('phone', 'email')->where('id', $uid)->first();

        $phone = $userinfo->phone;

        $email = $userinfo->email;

        $phoneBegin = str_split($phone, '3')[0];

        $emailBegin = str_split($email, '3')[0];

        $phoneEnd = substr($phone, '8');

        //$emailEnd = explode('@', $email)[1];

        $phone = $phoneBegin.'*****'.$phoneEnd;

        $email = $emailBegin.'*****@';

        return view('Home.Person.safety', ['phone'=>$phone, 'email'=>$email]);
    }

    /**
     * 显示修改密码页面
     * 
     * @return view password,
     */
    public function passwordEdit() 
    {
        return view('Home.Person.password');
    }

    /**
     * 修改密码的操作
     * 
     * @return view password,
     */
    public function doPasswordEdit(CheckPwd $request) 
    {
        $captcha = $request->input('captcha');

        if ($captcha != session('code')) {
            return back()->with('errormsg', '你输入的验证码有误');
        } 

        $oldpassword = $request->input('oldpassword');

        //!查找这个用户的原密码()得用session的密码
        $uid = session('homeUser')->id;
        $data = DB::table('shop_home_user')->where('id', $uid)->value('pwd');

        if (!Hash::check($oldpassword, $data)) {

            return back()->with('errormsg', '你输入的原密码有误');
        }

        $password = $request->input('password');

        $repassword = $request->input('repassword');

        if($password != $repassword) {

            return back()->with('errormsg', '你输入的两次密码不一样');
        } else {

            $hashPwd = Hash::make($password);

            DB::table('shop_home_user')->where('id', $uid)->update(['pwd'=>$hashPwd]);

            return redirect('home/safety')->with('msg', '密码已修改成功');
        }
        return back()->with('errormsg', '系统繁忙');
    }


    /**
     * 修改邮箱的页面
     * 
     * @return view email,
     */
    public  function emailEdit() 
    {
        return view('Home.Person.email');
    }

    /**
     * 处理真正的修改邮箱
     * 
     * @return msg
     */
    public function doEmailEdit(Request $request) 
    {
        return '绑定成功';
    }

    /**
     * 邮箱发送验证码
     * 
     * @return 
     */
    public function emailCode(Request $request) 
    {
        Mail::raw('验证码', function($message) {

            $email = $request->input('email');
            $time = time();
            $code = substr($time, '6'); 
            $emailinfo = '你的验证码是'.$code.',30分钟有效';

            $message->from('rockgyx@163.com', '糖糖商铺');
            $message->subject($emailinfo);
            $message->to('815984073@qq.com');

            session(['emailcode' => $code]);

        });

        
        return response()->json([

            'code' => '200',

        ]); 
    }



    public function send()
    {

        Mail::raw('邮箱验证码', function($message) {

            // $message->from('rockgyx@163.com', '糖糖商铺');
            $message->subject('杰哥,我用框架给你发了个邮箱');
            $message->to('815984073@qq.com');

            //session(['emailcode' => $code]);
            echo '123';

        });



    }
}
