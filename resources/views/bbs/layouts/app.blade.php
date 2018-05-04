<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AuroraBBS') - {{ setting('site_name', 'Laravel 进阶教程') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', 'AuroraBBS 爱好者社区。'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'AuroraBBS,社区,论坛,开发者论坛'))" />


    <!-- Styles -->
    <link href="{{ asset('css/bbs/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('bbs.layouts._header')

    <div class="container">

        @include('bbs.common._message')
        @yield('content')

    </div>

    @include('bbs.layouts._footer')
</div>

@if (app()->environment() !== 'production')
    @include('sudosu::user-selector')
@endif

<!-- Scripts -->
<script src="{{ asset('js/bbs/app.js') }}"></script>
@yield('scripts')
</body>
</html>