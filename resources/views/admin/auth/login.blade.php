<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="{{ asset('vendor/hAdmin/img/favicon.ico') }}">
    <link href="{{ asset('vendor/hAdmin/css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('vendor/hAdmin/css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">

    <link href="{{ asset('vendor/hAdmin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/hAdmin/css/style.css?v=4.1.0') }}" rel="stylesheet">

    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">h</h1>
        </div>
        <h3>欢迎使用 hAdmin</h3>

        <form class="m-t" role="form" method="post" action="{{ route('admin.login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" placeholder="邮箱" value="{{ old('email') }}" required="">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="密码" required="">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <input type="hidden" name="remember" value="1">
            <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>

            {{--<p class="text-muted text-center">
                <a href="{{ route('admin.password.request') }}">
                    <small>忘记密码了？</small>
                </a>
                |
                <a href="{{ route('admin.register') }}">注册一个新账号</a>
            </p>--}}
        </form>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('vendor/hAdmin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('vendor/hAdmin/js/bootstrap.min.js?v=3.3.6') }}"></script>

</body>
</html>
