<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>edit</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body" style="diaplay:inline-block;">
        <form method="post" action="{{url('doEditBS')}}" enctype="multipart/form-data" style="diaplay:inline-block;">
          <div class="layui-form-item">
              <label for="goodsname" class="layui-form-label">
                  <span class="x-red">*</span>所有商品
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="name" readonly name="name" value="{{$allParentsType['goods_name']}}" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="brandname" class="layui-form-label">
                  <span class="x-red">*</span>品牌名
              </label>
              <div class="layui-input-inline">
                  <select name="goodsname" id="goodsname">
                    <option value="-1">-请选择-</option>
                  </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="typename" class="layui-form-label">
                  <span class="x-red">*</span>顶级分类
              </label>
              <div class="layui-input-inline">
                  <select name="typename" id="typename">
                    <option value="-1">-请选择-</option>
                  </select>
              </div>
          </div>

          <div class="layui-form-item" style="diaplay:inline-block;">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn">
                  修改
              </button>

              <form style="diaplay:inline-block;">
                <a href="{{url('allgoods')}}" class="layui-btn">
                      返回
                </a>
              </form>
          </div>
          <div style="diaplay:inline-block;">
              <label class="layui-form-span">
              <label for="L_repass" class="layui-form-label">
              </label>
              
              </label>
          </div>
      </form>
    </div>

  </body>

</html>