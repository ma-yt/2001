<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <center><h2>新闻添加</h2></center>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<form action="{{url('/news/create')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">新闻标题</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="n_title" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">新闻分类</label>
        <div class="col-sm-10">
            <select name="cid">
                <option value="0">请选择</option>
                @foreach($res as $v)
                <option value="{{$v->cid}}">{{$v->cname}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">新闻图片</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="n_img" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">新闻简介</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="n_jj" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">新闻内容</label>
        <div class="col-sm-10">
            <input type="" class="form-control" name="n_content" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>

</body>
</html>