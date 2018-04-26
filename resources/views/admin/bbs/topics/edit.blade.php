@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑话题</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.topics.update', [$topic->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">姓名：</label>
                            <div class="col-sm-8">
                                <input id="cname" name="name" value="{{ $user->name or '' }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">邮箱：</label>
                            <div class="col-sm-8">
                                <input id="cemail" type="email" class="form-control" name="email" value="{{ $user->email or '' }}" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-8">
                                <input id="curl" type="password" class="form-control" name="password" value="" placeholder="******" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">简介：</label>
                            <div class="col-sm-8">
                                <textarea id="ccomment" name="introduction" class="form-control" required="" aria-required="true">{{ $user->introduction or '' }}</textarea>
                            </div>
                        </div>
                        @include('admin.common.error-tip-right')
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/webuploader/webuploader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/webuploader/style.css') }}">
@stop
@section('scripts')
    <!-- Web Uploader -->
    <script src="{{ asset('js/webuploader/webuploader.min.js') }}"></script>
    <script>
        var upload_url = '{{ route('admin.upload_avatar') }}',
            csrf_token = '{{ csrf_token() }}',
            input_val = $('input[name="avatar"]'),
            fileNumLimit = 1;
    </script>
    <script type="text/javascript" src="{{ asset('js/webuploader/base-setting.js') }}"></script>
@stop