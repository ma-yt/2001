@extends('admin.layouts.adminhop')
@section('content')
        <!-- 内容主体区域 -->
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>
                <span class="layui-breadcrumb">
                  <a href="">后台首页</a>
                  <a href="">商品品牌</a>
                  <a href="">品牌列表</a>
                </span>
            </legend>
        </fieldset>

        <form class="layui-form" action="">
        <div class="layui-form-item">
            <div class="layui-inline">

                <div class="layui-input-inline">
                    <input type="tel" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">

                <div class="layui-input-inline">
                    <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入品牌网址" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">

                <div class="layui-input-inline">
                    <button class="layui-btn layui-btn-normal">搜索</button>
                </div>
            </div>
        </div>
        </form>

        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th><input type="checkbox" name="allcheckbox" lay-skin="primary"  ></th>
                    <th>品牌id</th>
                    <th>品牌名称</th>
                    <th>品牌logo</th>
                    <th>品牌网址</th>
                    <th>品牌介绍</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                <tr>
                    <td><input type="checkbox" name="brandcheck[]" value="{{$v->brand_id}}" lay-skin="primary" ></td>
                    <td>{{$v->brand_id}}</td>
                    <td id="{{$v->brand_id}}" oldval="{{$v->brand_name}}"><span class="brand_name">{{$v->brand_name}}</span></td>
                    <td>
                        @if($v->brand_logo)
                        <img src="{{$v->brand_logo}}" width="100" height="110">
                        @endif
                    </td>
                    <td>{{$v->brand_url}}</td>
                    <td>{{$v->brand_desc}}</td>
                    <td>
                        {{--<a href="javascript:void(0)" onclick="if(confirm('确定删除这条记录吗?')) { location.href='{{url('/brand/delete/'.$v->brand_id)}}'; }" class="layui-btn layui-btn-danger">删除</a>--}}
                        <a href="javascript:void(0)" onclick="del({{$v->brand_id}},this)" class="layui-btn layui-btn-danger">删除</a>
                        <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="layui-btn layui-btn-normal">编辑</a>
                    </td>
                </tr>
                @endforeach

                <tr><td colspan="7">
                        {{$data->appends($query)->links('vendor.pagination.adminshop')}}
                        <button type="button" class="layui-btn layui-btn-normal moredel">批量删除</button>
                    </td></tr>
                </tbody>
            </table>
        </div>

<script src="/static/admin/layui-v2.5.6/layui/layui.js"></script>
<script src="/static/admin/layui-v2.5.6/layui/jquery.min.js"></script>
<script>
    //即点即改
    $(document).on('click','.brand_name',function(){
        var brand_name = $(this).text();
        var id = $(this).parent().attr('id');
        $(this).parent().html('<input type=text class="changename input_name_'+id+'" value='+brand_name+'>');
        $('.input_name'+id).val("").focus().val(brand_name);
    });
    $(document).on('blur','.changename',function(){
        var newname = $(this).val();
        if(!newname){
            alert('内容不能为空');return;
        }
        var oldval = $(this).parent().attr('oldval');
        if(newname==oldval){
            $(this).parent().html('<span class="brand_name">'+newname+'</span>');
            return;
        }
        var id = $(this).parent().attr('id');
        var obj = $(this);
        $.get('/brand/change',{id:id,newname:newname},function(res){
            //alert(res.msg);
            if(res.code==0){
                obj.parent().html('<span class="brand_name">'+newname+'</span>');
            }
        },'json')
    })

    //JavaScript代码区域
    layui.use(['element','form'], function(){
        var element = layui.element;
        var form = layui.form;
    });

    //全选
    $(document).on('click','.layui-form-checkbox:eq(0)',function(){
        var checkval = $('input[name="allcheckbox"]').prop('checked');
        $('input[name="brandcheck[]"]').prop('checked',checkval);
        if(checkval){

            $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
        }else{
            $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
        }

    })

    //批量删除
    $(document).on('click','.moredel',function(){
        var id = new Array();
        $('input[name="brandcheck[]"]:checked').each(function(i,k){
            id.push($(this).val());
        });
        $.get('/brand/delete',{id:id},function(res){
            alert(res.msg);
            //$(obj).parents('tr').hide();
            location.reload();
        },'json')
    })

    //ajax删除
    function del(brand_id,obj){
        if(!brand_id){
            return;
        }
        $.get('/brand/delete/'+brand_id,function(res){
            alert(res.msg);
            //$(obj).parents('tr').hide();
            location.reload();
        },'json')
    }

    //ajax分页
    $(document).on('click','.layui-laypage a',function(){
        //$('.layui-laypage a').click(function(){
        var url = $(this).attr('href');
        $.get(url,function(res){
            $('tbody').html(res);
            layui.use(['element','form'], function(){
                var element = layui.element;
                var form = layui.form;
                form.render();
            });
        })

        return false;
    })
</script>

@endsection


