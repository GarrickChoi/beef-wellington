<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>分类列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('Admin/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin/js/xadmin.js')}}"></script>
    <link rel="stylesheet" href="{{asset('statics/bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <!-- <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新"> -->
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('allgoods')}}"  title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form action="{{url('allgoods')}}" method="get" class="layui-form layui-col-md12 x-so layui-form-pane">
          <input class="layui-input" placeholder="商品ID/品名" name="goods_info">
          <button class="layui-btn" lay-submit lay-filter="sreach"><i class="layui-icon"></i> 搜索</button>
        </form>
      </div>
      <xblock>
        <button name="recoveryData" class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i> 批量删除</button>
        <!-- <a class="layui-btn layui-btn-normal" href="{{url('restoreG')}}"><i class="layui-icon"></i>  批量恢复</a> -->
        <a class="layui-btn" href="{{url('addGoods')}}"><i class="layui-icon"></i> 增加</a>
        <span class="x-right" style="line-height:40px">本页数据：{{ $goodsInfo->count() }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i name="checkedAll" class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>品名</th>
            <th>品牌</th>
            <th>分类</th>
            <th>价格</th>
            <th>库存</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach ($goodsInfo as $k => $v)
            <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" title="{{$v->id}}" data-id='{{$v->id}}'><i name="singleChecked" class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td style="width:125px;height:30px;overflow:hidden;">{{$v->name}}</td>
            <td bid="{{$v->bid}}">{{$goodsInfo[$k]->brand_name}}</td>
            <td tid="{{$v->tid}}">
            <a title="点击我修改" style="text-decoration:underline;color:{{$goodsInfo[$k]->type_pid == 0?'red' : 'orange'}};" href="{{url('manageGT',[$v->id,$goodsInfo[$k]->type_pid])}}">
            {{$goodsInfo[$k]->type_pid == 0? '还未选择子分类' :$goodsInfo[$k]->type_name}}
            <i class="layui-icon">&#xe642;</i></a>
            </td>
            <td>{{$v->price}}</td>
            <td>{{$v->store}}</td>
            <td>
                @if ($v->status == 1) 
                <a name="operateIt" class="layui-btn layui-btn-normal layui-btn-mini" gid="{{$v->id}}" gstatus="{{$v->status}}" href="javascript:;">
                <span>新添加</span>
                </a>
                @elseif ($v->status == 2)
                <a name="operateIt" class="layui-btn layui-btn-normal layui-btn-mini" gid="{{$v->id}}" gstatus="{{$v->status}}" href="javascript:;">
                <span>在售中</span>
                </a>
                @else
                <a name="operateIt" style="background:gray;" class="layui-btn layui-btn-normal layui-btn-mini" gid="{{$v->id}}" gstatus="{{$v->status}}" href="javascript:;">
                <span>已下架</span>
                </a>
                @endif
            </td>
            <td class="td-manage">
              <a title="编辑" href="{{url('editGoods',[$v->id])}}">
                <i class="layui-icon">&#xe642;</i><font color="blue">编辑</font>
              </a>　|　
              <a name="deleteIt" title="删除" gid="{{$v->id}}" href="javascript:;">
                <i class="layui-icon">&#xe640;</i><font color="red">删除</font>
              </a>
              
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="page">
          {{ $goodsInfo->appends(['searchInfo' => $searchInfo])->links() }}
      </div>

    </div>

    <script>

     

      $("i[name='singleChecked']").on({click:function (){

          var obj = $(this).parent().parent().next();

          if (obj.attr('checkedIt') == null) {
              obj.attr('checkedIt',true);
          }else if (obj.attr('checkedIt') == "true") {
              obj.attr('checkedIt',false);
          } else {
              obj.attr('checkedIt',true);
          }
          
      }});

      var flag = 'F';
      $("i[name='checkedAll']").click(function() {
          var obj = $("i[name='singleChecked']").parent().parent().next();

          if (obj.attr('checkedIt') == null) {
              obj.attr('checkedIt',true);
          }else {
              if (flag == 'T') {
                obj.attr('checkedIt',true);
                flag = 'F';
              } else {
                obj.attr('checkedIt',false);
                flag = 'T';
              }
          }
      });


      $("a[name='deleteIt']").click(function() {

          var obj = $(this);

          var gid = obj.attr('gid');

          layer.confirm('确定删除数据吗？',function(){

              $.ajax({
                  type:'get',
                  url:"{{url('disabledGoods')}}",
                  data:'id=' + gid,
                  success:function(data) {

                    if (data.code == "2444") {

                        layer.msg('删除成功!',{icon:1,time:1000});

                        obj.parents('tr').remove();

                        location.href = "{{url('allgoods')}}";

                    } else {

                        layer.msg(data.msg,{icon:2,time:1000});

                    }
                  },
                  dataType:'json'
              });

          });
      });

      $("a[name='operateIt']").click(function () {
        var that = $(this);
        var gid = $(this).attr('gid');
        var status = $(this).attr('gstatus');
        var answer = confirm('确定要修改此项吗?')
      
        if (answer) {
            //用ajax请求修改状态
              $.ajax({
                type:'get',
                url:"{{'changeGoods'}}",
                data:'gid=' + gid + "&gstatus=" + status,
                success:function (data) {
                  if (data.code == '666') {
                    var obj = that.children().html(data.status == 1?'新添加':(data.status == 2?'在售中':'已下架'));
                    if (data.status == 1 || data.status == 2) {
                     
                      obj.parent().css('background','rgb(30, 159, 255)');
                      that.attr('gstatus',data.status);
                    } else {
                     
                      obj.parent().css('background','gray');
                      that.attr('gstatus',data.status);
                      // obj.parents('tr').remove();

                    }
                  } else {

                    alert(data.msg);

                  }
                  
                },
                dataType:'json'
              });
          }

        });

      $("button[name='recoveryData']").click(function() {

          layer.confirm('确认要删除数据吗？',function(){
          
              var str = '';
              var obj = $("td[checkedIt='true']");

              obj.each(function() {
                  str += $(this).text();
                  str += '-';
              });

              $.ajax({
                  type:'get',
                  url:"{{'disabledAllGoods'}}",
                  data:'id=' + str,
                  success:function(data) {
                    if (data.code == "666") {

                        layer.msg('删除数据成功!',{icon:1,time:1000});
                        obj.parents('tr').remove();
                        location.href = "{{url('allgoods')}}";

                    } else {

                        layer.msg(data.msg,{icon:2,time:1000});

                    }
                  },
                  dataType:'json'
              });

          });
          
      });

      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

   

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>