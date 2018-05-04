@extends('admin.layouts.app')

@section('title', '会员列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>会员列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                        <form action="{{ route('admin.bbs.users.index') }}" method="get">
                            <div class="col-sm-1">
                                <select name="type" class="input-sm form-control input-s-sm inline">
                                    <option value="1"
                                            @if(isset($params['type']) && $params['type'] == 1) selected @endif>ID
                                    </option>
                                    <option value="2"
                                            @if(isset($params['type']) && $params['type'] == 2) selected @endif>用户名
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="value"
                                           value="@if(isset($params['value'])) {{$params['value'] or ''}}@endif"
                                           placeholder="请输入关键词" class="input-sm form-control">
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if(isset($users) && count($users))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>头像</th>
                                    <th>简介</th>
                                    <th>最后活跃时间</th>
                                    <th>注册时间</th>
                                    <th>编辑</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $user->id or '-' }}</td>
                                        <td>{{ $user->name or '-' }}</td>
                                        <td>{{ $user->email or '-' }}</td>
                                        <td><a href="{{ $user->avatar or '-' }}" target="_blank"><img
                                                        src="{{ $user->avatar or '-' }}"></a></td>
                                        <td>{{ $user->introduction or '-' }}</td>
                                        <td>{{ $user->last_actived_at or '-' }}</td>
                                        <td>{{ $user->created_at or '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.bbs.users.edit', [$user->id]) }}"
                                               class="btn btn-info user-edit">编辑</a>
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.bbs.users.destroy', [$user->id]) }}"
                                                    data-json='{"_token": "{{ csrf_token() }}", "_method": "DELETE"}'>删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {!! $users->render() !!}
                            </div>
                        @else
                            <div class="col-sm-12" style="text-align: center;padding: 10px;">没有检索到数据！</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <style>
        img {
            width: 40px;
            height: 40px;
        }
    </style>
@stop
