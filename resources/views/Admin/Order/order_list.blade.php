<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
  </head>
  
  <body>

    
    <!-- 公共部分 -->
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <!-- 结束公共部分 -->


    <div class="x-body">
      <div class="layui-row">

        <!-- 表单开始 -->
        <!-- 1:待付款 2：待发货 3：待收货 4：已完成 5：已取消 6：待评价 -->
        <form action="{{url('admin/order_index')}}" class="layui-form layui-col-md12 x-so" method="get">
          <div class="layui-input-inline">
            <select name="order_stat">
              <option value="">订单状态</option>
              <option value="">所有订单</option>
              <option value="1" {{ $order_stat == 1? 'selected' : ''}}>待付款</option>
              <option value="2" {{ $order_stat == 2? 'selected' : ''}}>待发货</option>
              <option value="3" {{ $order_stat == 3? 'selected' : ''}}>待收货</option>
              <option value="4" {{ $order_stat == 4? 'selected' : ''}}>已完成</option>
              <option value="5" {{ $order_stat == 5? 'selected' : ''}}>已取消</option>
              <option value="6" {{ $order_stat == 6? 'selected' : ''}}>已评价</option>
            </select>
          </div>
          <input type="text" name="order_num" value="{{$order_num}}" placeholder="请输入订单号" autocomplete="off" class="layui-input">    
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
        <!-- 表单结束 -->


      </div>
      <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加用户','./order-add.html')" style="height:0px; width:0px"><!-- <i class="layui-icon"></i>添加 --></button>
        <span class="x-right " style="line-height: center">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">

        <thead>
          <tr>
            <th style="text-align:center">订单编号</th>
            <th style="text-align:center">收货地址</th>
            <th style="text-align:center">收货人:电话</th>
            <th style="text-align:center">总金额</th>
            <th style="text-align:center">订单状态</th>
            <th style="text-align:center">现在发货</th>
            <th style="text-align:center">下单时间</th>
            <th style="text-align:center">操作</th>
          </tr>
        </thead>

        <!-- 遍历的订单列表 -->
        @foreach ($order_list_arr as $v)
        <tbody>
          <tr style="height: 57px">
            <td style="text-align:center">{{$v->order_num}}</td>
            <td style="text-align:center">{{$v->address}}</td>
            <td style="text-align:center">{{$v->uname}}:{{$v->phone}}</td>
            <td style="text-align:center">{{$v->total}}</td>

            <!-- 订单的状态 -->
            <!--1:待付款 2：待发货 3：待收货 4：已完成 5：已取消 6：待评价  -->
            <td style="text-align:center">
            @switch($v->status)
              @case(1)
                待付款
              @break

              @case(2)
                待发货
              @break

              @case(3)
                待收货
              @break

              @case(4)
                已完成
              @break

              @case(5)
                已取消
              @break

              @case(6)
                待评价
              @break

              @default
                订单有误
            @endswitch
            </td>

            <td style="text-align:center"><a order_id={{$v->id}} href="javascript:;" class="{{$v->status == 2? 'layui-btn layui-btn-danger' : ''}}">{{$v->status == '2'? '现在发货' : '' }}</a></td>
            <td style="text-align:center">{{$v->addtime}}</td>
            <td class="td-manage" style="text-align:center">
              <a title="订单详情"  onclick="x_admin_show('订单详情','{{url('admin/order_detail/'.$v->id)}}')" href="javascript:;">
                <i class="layui-icon">&#xe63c;</i>
              </a>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>

      <div class="page">
        <div>
           {{ $order_list_arr->appends(['order_stat' => $order_stat])->links() }}
        </div>
      </div>

    </div>

    <script>
    //给待发货状态改变成代收货
    $('tr td:nth-child(6) a').click(function () {

      var order_id = $(this).attr('order_id');

      var that = $(this);

      var bool = confirm('确定现在发货吗？');

      if (!bool) {

        alert('取消了发货');
        return false;
      }

      $.ajax({

        type: 'get',
        url: '{{url("admin/order_change")}}',
        dataType: 'json',
        data: 'id='+order_id,

        success: function (msg) {

          if (msg.code == 200) {

            alert(msg.msg);

            that.parent().prev().html('待收货');

            that.remove();

          }

          if (msg.code == 400) {

            alert(msg.msg);
            //可以跳回登录页面
          }

        }

      });

    });
    </script>

  </body>

</html>