@extends('admin.layouts.adminhop')
@section('content')
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>
                <span class="layui-breadcrumb">
                  <a href="">后台首页</a>
                  <a href="">商品品牌</a>
                  <a href="">编辑品牌</a>
                </span>
            </legend>
        </fieldset>

        <div style="padding: 15px;">
             @if ($errors->any())
                <div class="alert alert-danger" style="padding-bottom: 20px;padding-left: 20px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="margin-top:10px; color:#ff0000">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="layui-form" action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="layui-form-item">
                    <label class="layui-form-label">品牌名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="brand_name" value="{{$data->brand_name}}" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">品牌logo</label>
                    <div class="layui-input-block">
                        {{--<input type="file" name="brand_logo" lay-verify="title" autocomplete="off" placeholder="请输入品牌logo" class="layui-input">--}}
                        <div class="layui-upload-drag" id="test10">
                            <i class="layui-icon"></i>
                            <p>点击上传，或将文件拖拽到此处</p>
                            <div @if(!$data->brand_logo)class="layui-hide" @endif id="uploadDemoView">
                                <hr>
                                <img src="{{$data->brand_logo}}" alt="上传成功后渲染" style="max-width: 196px">
                            </div>
                        </div>
                        <input type="hidden" name="brand_logo" @if($data->brand_logo) value="{{$data->brand_logo}}" @endif/>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">品牌网址</label>
                    <div class="layui-input-block">
                        <input type="text" name="brand_url" value="{{$data->brand_url}}" lay-verify="title" autocomplete="off" placeholder="请输入品牌网址" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">品牌介绍</label>
                    <div class="layui-input-block">
                        <input type="text" name="brand_desc" value="{{$data->brand_desc}}" lay-verify="title" autocomplete="off" placeholder="请输入品牌介绍" class="layui-input">
                    </div>
                </div>

                <div align="center">
                    <button type="submit" class="layui-btn">编辑</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>

            </form>
        </div>
    </div>

    {{--<div class="layui-footer">--}}
        {{--<!-- 底部固定区域 -->--}}
        {{--© layui.com - 底部固定区域--}}
    {{--</div>--}}
</div>
<script src="/static/admin/layui-v2.5.6/layui/layui.js"></script>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
    layui.use('upload', function(){
        var $ = layui.jquery
                ,upload = layui.upload;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        upload.render({
            elem: '#test10'
            ,url: 'http://www.2001.com/brand/upload' //改成您自己的上传接口
            ,done: function(res){
                layer.msg(res.msg);
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
//                console.log(res)
                $('input[name="brand_logo"]').attr('value',res.data);
            }
        });
    });

</script>
@endsection