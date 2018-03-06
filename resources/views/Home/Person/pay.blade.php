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
        <h2>请您确认你的信息</h2>
        <div class="successInfo">
            <ul>
                <li>付款金额<em>¥{{number_format($total, '2')}}</em></li>
                <div class="user-info">
                <p>收货人：{{$name}}</p>
                <p>联系电话：{{$phone}}</p>
                <p>收货地址：{{$address}}</p>
                </div>
                    请认真核对您的收货信息，如有错误请联系客服            
            </ul>
        <div class="option">
            <span class="info">您可以</span>
            <form action="{{url('home/pay_over')}}" method="get">
            <input type="hidden" name="oid" value="{{$oid}}">
            <a href="javascript:;" class="J_MakePoint"><span><button>立即付款</button></span></a>
            <!-- <a href="../person/orderinfo.html" class="J_MakePoint">查看<span>交易详情</span></a> -->
            </form>
        </div>
        </div>
    </div>
</div>
@include('Common.footer')
</body>
</html>
<SCRIPT Language=VBScript><!--

//--></SCRIPT>