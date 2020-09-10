@foreach($data as $v)
    <tr>
        <td><input type="checkbox" name="brandcheck[]" value="{{$v->brand_id}}" lay-skin="primary" ></td>
        <td>{{$v->brand_id}}</td>
        <td id="{{$v->brand_id}}"><span class="brand_name">{{$v->brand_name}}</span></td>
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