<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台系统管理</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="{{asset('Admin/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
    <link rel="stylesheet" href="{{asset('statics/bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">

</head>
<body class="login-bg">
    <div name = 'success' class="alert alert-danger" style="display:none">
            <p name = "success-msg"></p>
    </div>
    <div class="login">
        <div class="message">用户登录</div>
        <div id="darkbannerwrap"></div>
        <form  class="layui-form" action="javascript:;" method="post">
            {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <div name = "username" style="color:red"></div>
            <br>
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <div name = 'pwd' style="color:red"></div>
            <br>
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit" name="login">
            <hr class="hr20" >
        </form>
    </div>

    <script>

        $('input[name = username]').focus(function() {
            $('div[name = username]').text('');
            $('input[name = username]').css({'border': '1px solid #C9C9C9'});
        });

         $('input[name = password]').focus(function() {
            $('div[name = pwd]').text('');
            $('input[name = password]').css({'border': '1px solid #C9C9C9'});
        });

        $('input[name = login]').click(function() {
            //var that = $(this);
            //alert('123');
            var username =  $('input[name = username]').val();
            var password =  $('input[name = password]').val();

            $.ajax({
                type: 'post',
                url: '{{url("admindologin")}}',
                data:  {"username":username, "password":password},
                success: function (data)
                {
                    
                    //console.log(data);
                    if (data.code == 111) {
                        
                        //alert(data.info);
                        $('div[name = username]').text('用户名不存在');
                        $('input[name = username]').css({'border': '1px solid red'});

                    } else if (data.code == 222) {

                        $('div[name = pwd]').text('密码错误');
                        $('input[name = password]').css({'border': '1px solid red'});

                    } else if (data.code == 200) {

                        $('div[name = success]').css({'display' : 'block'})
                        $('p[name = success-msg]').text('登录成功,2秒后将登入后台系统......');


                        setTimeout(function () {   
                                 window.location.href = '{{url("/AdminIndex")}}';    
                              },2000);      
                        

                    } else if (data.code == 101) {

                        $('div[name = success]').css({'display' : 'block'})
                        $('p[name = success-msg]').text('您的账户已被禁用，请联系超级管理员');

                    }
                }

            });
        });
    </script>
    
    <!-- 底部结束 -->
    
</body>
</html>