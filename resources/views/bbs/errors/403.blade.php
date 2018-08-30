<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AuroraBBS') - {{ setting('site_name', 'Laravel 进阶教程') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', 'AuroraBBS 爱好者社区。'))"/>
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'AuroraBBS,社区,论坛,开发者论坛'))"/>


    <!-- Styles -->
    <link href="{{ asset('css/bbs/app.css') }}" rel="stylesheet">
    <style>
        .wrapper {
            width: 760px;
            margin: 0 auto 5em auto;
        }

        .error-spacer {
            height: 4em;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="error-spacer"></div>
    <div id="app" class="{{ route_class() }}-page" style="text-align: center;">
        <h1><(￣3￣)> </h1>
        <h2>Server Error: 403 (Forbidden)</h2>
        <hr>
        <h3>这意味着什么？</h3>
        <p>
            我们没有在服务器上找到您请求的页面，真的很抱歉。
        </p>
        <p>这是我们的错，不是您的。</p>
        <p>我们将努力尽快找到这个页面。</p>
        <p>
            或许你想返回我们的 <a href="{{ config('app.bbs_url') }}" style="font-size: 32px;">首 页</a>?
        </p>
    </div>
</div>
@if (app()->environment() !== 'production')
    @include('sudosu::user-selector')
@endif

<!-- Scripts -->
<script src="{{ asset('js/bbs/app.js') }}"></script>
</body>
</html>