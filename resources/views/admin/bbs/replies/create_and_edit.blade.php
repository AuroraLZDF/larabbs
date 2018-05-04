@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>@if(isset($reply) && $reply)编辑@else创建@endif回复</h5>
                </div>
                <div class="ibox-content">
                    @if(isset($reply) && $reply)
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.replies.update', [$reply->id]) }}">
                        {{ method_field('PUT') }}
                    @else
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.replies.store') }}">
                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">论坛用户：</label>
                            <div class="col-sm-2">
                                <a href="javascript:;" class="btn btn-info" id="btn_user" data-url="{{ route('admin.api_bbs_user_lists') }}">
                                    @if( isset($reply->user) && $reply->user->name){{ $reply->user->name }}@else请选择用户@endif
                                </a>
                                <input name="user_id" value="{{ $reply->user_id or '' }}" minlength="2" type="hidden" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">论坛话题：</label>
                            <div class="col-sm-8">
                                <a href="javascript:;" class="btn btn-info" id="btn_topic" data-url="{{ route('admin.api_bbs_topic_lists') }}">
                                    @if( isset($reply->topic) && $reply->topic->title){{ $reply->topic->title }}@else请选择话题@endif
                                </a>
                                <input name="topic_id" value="{{ $reply->topic_id or '' }}" minlength="2" type="hidden" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">评论内容：</label>
                            <div class="col-sm-8">
                                <textarea id="ccomment" name="content" class="form-control" required="" aria-required="true">{{ $reply->content or '' }}</textarea>
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

    <div class="modal fade" id="topicModel" tabindex="-1" role="dialog" aria-labelledby="topicModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- layer javascript -->
    <script type="text/javascript" src="{{ asset('vendor/hAdmin') }}/js/plugins/layer/layer.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#btn_user').click(function (event) {
                event.preventDefault();
                var url = $(this).data('url');
                layer.open({
                    type: 2,
                    title: '论坛会员列表',
                    content: [url, 'no'],   // no iframe不出现滚动条
                    area: ['30%', '60%'],
                    skin: 'layui-layer-rim', //加上边框
                });
            });

            $('#btn_topic').click(function (event) {
                event.preventDefault();
                var url = $(this).data('url');
                layer.open({
                    type: 2,
                    title: '论坛话题列表',
                    content: [url, 'no'],
                    area: ['36%', '60%'],
                    skin: 'layui-layer-rim', //加上边框
                });
            });
        });
    </script>
@stop
