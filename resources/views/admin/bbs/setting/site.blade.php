@extends('admin.layouts.app')

@section('title', '论坛站点设置')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>论坛站点设置</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.bbs.site') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">站点名称：</label>
                            <div class="col-sm-8">
                                <input name="site_name" value="{{ $data->site_name or '' }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">联系人邮箱：</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="contact_email" value="{{ $data->contact_email or '' }}" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SEO - Description：</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="seo_description" value="{{ $data->seo_description or '' }}" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">SEO - Keywords：</label>
                            <div class="col-sm-8">
                                <textarea name="seo_keyword" class="form-control" required="" aria-required="true">{{ $data->seo_keyword or '' }}</textarea>
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
