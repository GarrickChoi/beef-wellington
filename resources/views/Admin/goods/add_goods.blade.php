<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
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
    <div class="x-body">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <form class="layui-form" action="{{url('addNewGoods')}}" method="post" enctype="multipart/form-data">
          <div class="layui-form-item">
              <label for="goodsname" class="layui-form-label">
                  <span class="x-red">*</span>商品名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="goodsname" name="goodsname" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
               <label for="brand" class="layui-form-label">
                  <span class="x-red">*</span>品牌名
              </label>
              <div class="layui-input-inline">
                  <select id="brand" name="brand" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['brand'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="type" class="layui-form-label">
                  <span class="x-red">*</span>分类名
              </label>
              <div class="layui-input-inline">
                  <select id="type" name="type" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['type'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="color" class="layui-form-label">
                  <span class="x-red">*</span>颜　色
              </label>
              <div class="layui-input-inline">
                  <select id="color" name="color" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['colors'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="ingredient" class="layui-form-label">
                  <span class="x-red">*</span>材　料
              </label>
              <div class="layui-input-inline">
                  <select id="ingredient" name="ingredient" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['ingredient'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="market" class="layui-form-label">
                  <span class="x-red">*</span>销售渠道
              </label>
              <div class="layui-input-inline">
                  <select id="market" name="market" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['market'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="Basic_style" class="layui-form-label">
                  <span class="x-red">*</span>基础风格
              </label>
              <div class="layui-input-inline">
                  <select id="Basic_style" name="Basic_style" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['style'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="season" class="layui-form-label">
                  <span class="x-red">*</span>季节分类
              </label>
              <div class="layui-input-inline">
                  <select id="season" name="season" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['season'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
               <label for="objects" class="layui-form-label">
                  <span class="x-red">*</span>适用对象
              </label>
              <div class="layui-input-inline">
                  <select id="objects" name="objects" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['objects'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="price" class="layui-form-label">
                  <span class="x-red">*</span>价　格
              </label>
              <div class="layui-input-inline">
                  <input onkeyup="value=value.replace(/[^0-9.]+/,'')" type="text" id="price" name="price" required="" lay-verify="price" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label"><span class="x-red">*</span>是否促销</label>
              <div class="layui-input-block">
                  <input name="WDC" type="radio" lay-skin="primary" title="是">
                  <input name="WDC" type="radio" lay-skin="primary" title="否" checked="">
              </div>
          </div>
          <div id="dis" class="layui-form-item" style="display:none;">
              <label for="discount" class="layui-form-label">
                  <span class="x-red">*</span>折　扣
              </label>
              <div id="discount" class="layui-input-inline">
                  
              </div>
          </div>
          <div class="layui-form-item">
              <label for="store" class="layui-form-label">
                  <span class="x-red">*</span>库　存
              </label>
              <div class="layui-input-inline">
                  <input onkeyup="value=value.replace(/[^0-9]+]/,'')" type="number" min='0' id="store" name="store" required="" lay-verify="store"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
               <label for="status" class="layui-form-label">
                  <span class="x-red">*</span>商品状态
              </label>
              <div class="layui-input-inline">
                  <select id="status" name="status" class="valid">
                    <option value="-1">-请选择-</option>
                    @foreach ($allAttributes['status'] as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="layui-input-inline">
                  <a href="javascript:;" style="color:green;display:block;padding-top:9px;height:38px;vertical-align:middle"><i class="layui-icon"></i> 添加</a>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="pic" class="layui-form-label">
                  <span class="x-red">*</span>商品图片
              </label>
              <div class="layui-input-inline">
                  <input type="file" id="pic" name="pic[]" multiple="multiple" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item layui-form-text">
              <label for="desc" class="layui-form-label">
                  描述
              </label>
              <div class="layui-input-block">
                  <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
              <a class="layui-btn" href="{{url('allgoods')}}">返回</a>
          </div>
      </form>
    </div>
    <script>
        var oto = $("#discount");
        $('body').on('click','span,i',function() {

            var ans = '';
            var obj = $('#dis');

            if (this.tagName == "I"){
                ans = $(this).next().text();
            } else {
                ans = $(this).text();
            }

            if (ans == '是') {            
                obj.removeAttr('style');
                oto.empty();
                oto.append("<input onkeyup=\"value=value.replace(/[^0-9.]+/,'')\" type='text' name='discount' class='layui-input'>");
            } else {
                obj.attr('style','display:none');
                oto.children($('input[name="discount"]')).remove();
            }
        });
        




        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          // form.on('submit(add)', function(data){
          //   console.log(data);
          //   //发异步，把数据提交给php
          //   layer.alert("增加成功", {icon: 6},function () {
          //       // 获得frame索引
          //       var index = parent.layer.getFrameIndex(window.name);
          //       //关闭当前frame
          //       parent.layer.close(index);
          //   });
          //   return false;
          // });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>