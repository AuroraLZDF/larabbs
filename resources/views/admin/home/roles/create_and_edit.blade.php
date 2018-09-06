@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>@if($role->id)编辑@else添加@endif角色</h5>
                </div>
                <div class="ibox-content">
                    @if($role->id)
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.roles.update', [$role->id]) }}">
                        {{ method_field('PUT') }}
                    @else
                    <form class="form-horizontal m-t formAjax" id="commentForm" method="post" action="{{ route('admin.roles.store') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称：</label>
                            <div class="col-sm-8">
                                <input name="name" value="{{ old('name', $role->name) }}" minlength="2" type="text" class="form-control" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">guard：</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="guard_name" value="{{ old('guard_name', $role->guard_name) }}" required="" aria-required="true">
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
