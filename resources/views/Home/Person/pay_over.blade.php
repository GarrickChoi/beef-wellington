<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款页面</title>
<link rel="stylesheet"  type="text/css" href="{{asset('Home/AmazeUI-2.4.2/assets/css/amazeui.css')}}"/>
<link href="{{asset('Home/AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('Home/basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('Home/css/sustyle.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('Home/basic/js/jquery-1.7.min.js')}}"></script>

</head>

<body>

@include('Common.header')
<div class="take-delivery">
    <div class="status">
    @include('Common.msg')
    @include('Common.errormsg')
        <h2>支付成功</h2>
        <div class="successInfo">
        <div class="option">
            <span class="info">您可以</span>
            <a href="javascript:;" class="J_MakePoint" style="color: red">去个人中心<span></span>订单列表查看</a>
            <!-- <a href="../person/orderinfo.html" class="J_MakePoint">查看<span>交易详情</span></a> -->
        </div>
        </div>
    </div>
</div>
@include('Common.footer')
</body>
</html>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>