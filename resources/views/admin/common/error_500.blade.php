<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('500', setting('seo_500', ' - 500错误'))</title>
    <meta name="description" content="@yield('description', setting('seo_description', ''))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', ''))" />

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('vendor/hAdmin/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/bootstrap.min.css?v=3.3.6') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/font-awesome.css?v=4.4.0') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin/css/style.css?v=4.1.0') }}">
</head>
<body class="gray-bg">
<div class="middle-box text-center animated fadeInDown">
    <h1>500</h1>
    <h3 class="font-bold">{{ $message or '服务器内部错误' }}</h3>

    <div class="error-desc">
        服务器好像出错了...
        <br/>您可以返回主页看看
        <br/><a href="{{ route('admin.root') }}" class="btn btn-primary m-t">主页</a>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('vendor/hAdmin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('vendor/hAdmin/js/bootstrap.min.js?v=3.3.6') }}"></script>
</body>
</html>
