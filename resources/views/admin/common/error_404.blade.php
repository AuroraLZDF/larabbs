<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('404', setting('seo_404', ' - 404 页面'))</title>
    <meta name="description" content="@yield('description', setting('seo_description', ''))"/>
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', ''))"/>

    <link rel="shortcut icon" href="{{ asset('vendor/hAdmin/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/bootstrap.min.css?v=3.3.6') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/font-awesome.css?v=4.4.0') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/style.css?v=4.1.0') }}">

</head>

<body class="gray-bg">

<div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">页面未找到！</h3>

    <div class="error-desc">
        抱歉，页面好像去火星了~
        <form class="form-inline m-t" role="form">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="请输入您需要查找的内容 …">
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
        </form>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('vendor/hAdmin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('vendor/hAdmin/js/bootstrap.min.js?v=3.3.6') }}"></script>
</body>
</html>
