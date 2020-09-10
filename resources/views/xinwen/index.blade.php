<!DOCTYPE html>
<html>
<head>
    <center><h2>新闻列表</h2></center>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<table class="table">
    <caption>响应式表格布局</caption>
    <thead>
    <tr>
        <th>id</th>
        <th>新闻标题</th>
        <th>新闻分类</th>
        <th>新闻图片</th>
        <th>新闻简介</th>
        <th>新闻内容</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($res as $v)
        <tr>
            <td>{{$v->n_id}}</td>
            <td>{{$v->n_title}}</td>
            <td>{{$v->cid}}</td>
            <td>{{$v->n_img}}</td>
            <td>{{$v->n_jj}}</td>
            <td>{{$v->n_content}}</td>
            <td>
                <a href="">删除</a>
                <a href="">编辑</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>