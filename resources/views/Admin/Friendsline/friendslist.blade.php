<!DOCTYPE html>
<html>
  
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
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
        <div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a href="">友链管理</a>
                <a>
                    <cite>友链列表</cite>
                </a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div><br>
        <div class="x-body">
            <div class="layui-row">
                <form class="layui-form layui-col-md12 x-so" action="{{url('list')}}" method="get">
                    <input type="text" name="keyword"  placeholder="请输入链接名" autocomplete="off" class="layui-input" value="{{isset($key)?$key:''}}">
                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                </form>
            </div>
            <xblock>
                <button class="layui-btn" onclick="x_admin_show('添加链接','{{url('friendsline/create')}}')"><i class="layui-icon"></i>添加</button>
            </xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>链接名</th>
                        <th>链接地址</th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->url}}</td>
                            <td>
                                <a id="changit" style="background: {{$v->status == 1?'rgb(30,159,255)':'gray'}}" href="javascript:;" data-id="{{$v->id}}" data-status="{{$v->status}}" name="status" class="layui-btn layui-btn-normal layui-btn-mini">{{$v->status == 1?'已启用':'已禁用'}}
                                </a>
                            </td>
                            <td>{{$v->addtime}}</td>
                            <td class="td-manage">
                                <a style="display:inline-block" title="编辑"  onclick="x_admin_show('编辑','{{url('friendsline/'.$v->id.'/edit')}}')" href="javascript:;">
                                <i class="layui-icon">&#xe63c;</i>
                                </a>
                                <form style="display:inline-block" action="{{url('friendsline/'.$v->id)}}')" method="post"> 
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <button title="删除" style="border:0;background: white"><i class="layui-icon ">&#xe640;</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="page">
                <div>
                    @if (isset($key))  
                    {{$data->appends(['keyword' => $key])->links()}}
                    @else
                    {{$data->links()}}
                    @endif 
                </div>
            </div>
        </div>
        <script>

            $('a[name=status]').click('click',function() {
                var id = $(this).attr("data-id");
                var status = $(this).attr('data-status');
                var than = $(this);

                $.ajax({

                    type: 'get',
                    url: '{{url("status")}}',//请求php的路径
                    data:{"id":id,"status":status},
                    success:function (data) {
                        
                        if (data.code == 200) {
                            than.attr("data-status",data.status) ;
                            than.html(data.statustext);
                        } else {
                            alert(data.msg);
                        }

                        if (data.status == 1) {
                            than.css('background','rgb(30,159,255)');
                        } else {
                            than.css('background','gray');
                        }
                    },
                    dataType: 'json'
                });
            });
        
        </script>
    </body>
</html>