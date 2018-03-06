<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>edit</title>
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
    <div class="x-body" style="diaplay:inline-block;">
        <form method="post" action="{{url('doAddBS')}}" enctype="multipart/form-data" style="diaplay:inline-block;">
          <div class="layui-form-item" style="diaplay:inline-block;">
              <label for="name" class="layui-form-label">
                  <span class="x-red">*</span>品牌名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="name" name="name" required="" placeholder="新品牌名称" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item" style="diaplay:inline-block;">
              <label class="layui-form-label"><span class="x-red">*</span>状态</label>
              <div style="display:inline-block">
                <select name="status">
                  <option value="-6">——请选择——</option>
                  @foreach($allStatus as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div style="diaplay:inline-block;">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>品牌图片
              </label>
                <input type="file" name="brand_pic">
          </div>
          <div class="layui-form-item" style="diaplay:inline-block;">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn">
                  添加
              </button>

              <form style="diaplay:inline-block;">
                <a href="{{url('brand')}}" class="layui-btn">
                      返回
                </a>
              </form>
          </div>
          <div style="diaplay:inline-block;">
              <label class="layui-form-span">
              <label for="L_repass" class="layui-form-label">
              </label>
                @if (session('msg'))
                  <span class="x-red">*</span><span style="background:pink;font-size:21px;border-radius:25%;">{{ session('msg')}}</span>
                @endif
              </label>
          </div>
      </form>
    </div>

  </body>

</html>