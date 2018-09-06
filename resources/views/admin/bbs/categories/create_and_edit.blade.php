@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>@if(isset($category) && $category->id)编辑@else创建@endif分类</h5>
                </div>
                <div class="ibox-content">
                    @if(isset($category) && $category)
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.categories.update', [$category->id]) }}">
                        {{ method_field('PUT') }}
                    @else
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.categories.store') }}">
                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类名称：</label>
                            <div class="col-sm-8">
                                <input id="cname" name="name" value="{{ $category->name or '' }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">简介：</label>
                            <div class="col-sm-8">
                                <textarea id="ccomment" name="description" class="form-control" required="" aria-required="true">{{ $category->description or '' }}</textarea>
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
