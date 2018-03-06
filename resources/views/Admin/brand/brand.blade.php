<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>品牌列表</title>
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
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="{{url('brand')}}"  title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form action="{{url('brand')}}" method="get" class="layui-form layui-col-md12 x-so layui-form-pane">
          <input class="layui-input" placeholder="品牌名/品牌ID" name="brand_name" value="">
          <button class="layui-btn"><i class="layui-icon"></i> 搜索</button>
        </form>
      </div>
      <xblock>
        <button name="recoveryData" class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i> 批量删除</button>
        <a class="layui-btn layui-btn-normal" href="{{url('restoreBS')}}"><i class="layui-icon"></i> 批量恢复</a>
        <a class="layui-btn" href="{{url('addBS')}}"><i class="layui-icon"></i> 增加</a>
        <span class="x-right" style="line-height:40px">本页数据：{{ $allBrands->count() }} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i name="checkedAll" class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>品牌名</th>
            <th>图片路径</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($allBrands as $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" title="{{$v->id}}" data-id='{{$v->id}}'><i name="singleChecked" class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->album}}</td>
            <td>

                <!-- <a name="operateIt" class="layui-btn layui-btn-normal layui-btn-mini" b-id="{{$v->id}}" b-stat="{{$v->status}}" href="javascript:;"> -->
                <!-- <font color="green">启用</font> -->
                @if ($v->status == 1) 
                <a name="operateIt" class="layui-btn layui-btn-normal lay ui-btn-mini" b-id="{{$v->id}}" b-stat="{{$v->status}}" href="javascript:;">
                <span>已启用</span>
                </a>
                @else
                <a name="operateIt" style="background:gray;" class="layui-btn layui-btn-normal layui-btn-mini" b-id="{{$v->id}}" b-stat="{{$v->status}}" href="javascript:;">
                <!-- <font color="orange">禁用</font> -->
                <span>已禁用</span>
                </a>
                @endif
            </td>
            <td class="td-manage">
              <a title="编辑" href="{{url('editBS',[$v->id])}}">
                <i class="layui-icon">&#xe642;</i><font color="blue">编辑</font>
              </a>　|　
              <a title="删除" href="{{url('deleteBS',[$v->id])}}">
                <i class="layui-icon">&#xe640;</i><font color="red">删除</font>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
          {{ $allBrands->appends(['searchInfo' => $searchInfo])->links() }}
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
                  url:"{{url('disabledAllBrand')}}",
                  data:'id=' + str,
                  success:function(data) {
                    if (data.code == "666") {

                        layer.msg('删除数据成功!',{icon:1,time:1000});
                        obj.parents('tr').remove();
                        location.replace(location.href);

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
        var bid = $(this).attr('b-id');
        var status = $(this).attr('b-stat');
        var answer = confirm('确定要修改此项吗?')
      
        if (answer) {
            //用ajax请求修改状态
              $.ajax({
                type:'get',
                url:"{{'changeBS'}}",
                data:'bid=' + bid + "&status=" + status,
                success:function (data) {
                  if (data.code == '666') {
                    var obj = that.children().html(data.status == 1?'已启用':'已禁用');
                    if (data.status == 1) {
                      obj.parent().css('background','rgb(30, 159, 255)');
                      that.attr('b-stat',1);
                      obj.parents('tr').remove();
                    } else {
                      obj.parent().css('background','gray');
                      that.attr('b-stat',2);
                      obj.parents('tr').remove();
                    }
                  } else {
                    alert(data.msg);
                  }
                  
                },
                dataType:'json'
              });
          }

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

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

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