<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <center><h2>登录</h2></center>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<form action="{{url('/logindo')}}" method="post" class="form-horizontal" role="form">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">用户名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2  control-label">用户密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="pwd" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登录</button>
        </div>
    </div>
</form>

</body>
</html>