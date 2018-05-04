@extends('admin.layouts.app')

@section('title', '会员列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>评论列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                        <form action="{{ route('admin.bbs.replies.index') }}" method="get">
                            {{ csrf_field() }}
                            <div class="col-sm-1">
                                    <input type="text" name="id"
                                       value="@if(isset($params['id'])) {{$params['id'] or ''}}@endif"
                                       placeholder="请输入ID" class="input-sm form-control">

                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="name"
                                           value="@if(isset($params['name'])) {{$params['name'] or ''}}@endif"
                                           placeholder="请输入作者名称" class="input-sm form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" name="title"
                                           value="@if(isset($params['title'])) {{$params['title'] or ''}}@endif"
                                           placeholder="请输入话题名称" class="input-sm form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </form>
                        <div class="col-sm-3">
                                 <span class="input-group-btn" style="float: right;">
                                    <a href="{{ route('admin.bbs.replies.create') }}" class="btn btn-sm btn-primary"> 新增回复</a>
                                </span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(isset($replies) && count($replies))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>内容</th>
                                    <th>作者</th>
                                    <th>话题</th>
                                    <th>时间</th>
                                    <th>管理</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($replies as $key => $reply)
                                    <tr>
                                        <td>{{ $reply->id or '-' }}</td>
                                        <td>{{ $reply->content or '-' }}</td>
                                        <td><a href="{{ route('admin.bbs.users.index', ['type' => 1, 'value' => $reply->user->id]) }}">{{ $reply->user->name or '-' }}</a></td>
                                        <td><a href="{{ route('bbs.topics.show', ['topic' => $reply->topic]) }}" target="_blank">{{ $reply->topic->title or '-' }}</a></td>
                                        <td>{{ $reply->created_at or '-' }}</td>
                                        <td>
                                            <a class="btn btn-info " href="{{ route('admin.bbs.replies.edit', [$reply->id]) }}">编辑</a>
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.bbs.replies.destroy', [$reply->id]) }}">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {!! $replies->render() !!}
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
