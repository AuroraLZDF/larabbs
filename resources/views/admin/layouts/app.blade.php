<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('seo_title', 'Aurora - Admin'))</title>
    <meta name="description" content="@yield('description', setting('seo_description', ''))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', ''))" />

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('vendor/hAdmin') }}/img/favicon.ico">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin') }}/css/bootstrap.min.css?v=3.3.6">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin') }}/css/font-awesome.css?v=4.4.0">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('vendor/hAdmin') }}/css/style.css?v=4.1.0">
    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/hAdmin') }}/css/plugins/sweetalert/sweetalert.css">

    <style>
        th, td {  text-align: center;  }
    </style>

    @yield('styles')

</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    @include('admin.layouts._sideBar')
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('admin.layouts._header')

            <div class="wrapper wrapper-content">
            @yield('content')
            </div>

        {{--@include('admin.layouts._footer')--}}
    </div>
    <!--右侧部分结束-->
</div>

<!-- 全局js -->
<script src="{{ asset('vendor/hAdmin') }}/js/jquery.min.js?v=2.1.4"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/bootstrap.min.js?v=3.3.6"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="{{ asset('vendor/hAdmin') }}/js/hAdmin.js?v=4.1.0"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/index.js"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/content.js?v=1.0.0"></script>

<!-- 第三方插件 -->
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/pace/pace.min.js"></script>

<!-- Sweet alert -->
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- jQuery Validation plugin javascript-->
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/validate/jquery.validate.min.js"></script>
<script src="{{ asset('vendor/hAdmin') }}/js/plugins/validate/messages_zh.min.js"></script>

@yield('scripts')

</body>
</html>
