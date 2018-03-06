 <!DOCTYPE html>
<html>
  
  <head> 
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    
    <div class="x-body">
      <table class="layui-table">
        <thead>
          <tr>
            <th style="text-align:center">商品id</th>
            <th style="text-align:center">商品图片</th>
            <th style="text-align:center">商品描述</th>
            <th style="text-align:center">商品单价</th>
            <th style="text-align:center">商品个数</th>
            <th style="text-align:center">商品小计</th>           
          </tr>
        </thead>

        <tbody>
          @foreach ($order_detail as $v)
          <tr>
            <th style="text-align:center">待处理的错误</th>
            <th style="text-align:center"><img src="{{asset($v->gimg)}}"></th>
            <th style="text-align:center">{{$v->name}}</th>
            <th style="text-align:center">{{$v->price}}</th>
            <th style="text-align:center">{{$v->num}}</th>
            <th style="text-align:center">{{$v->count_num}}</th> 
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </body>
</html>