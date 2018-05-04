@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>@if(isset($link) && $link->id)编辑@else创建@endif外链</h5>
                </div>
                <div class="ibox-content">
                    @if(isset($link) && $link)
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.links.update', [$link->id]) }}">
                        {{ method_field('PUT') }}
                    @else
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.links.store') }}">
                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">外链名称：</label>
                            <div class="col-sm-8">
                                <input name="title" value="{{ $link->title or '' }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">链接地址：</label>
                            <div class="col-sm-8">
                                <input name="link" value="{{ $link->link or '' }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
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
