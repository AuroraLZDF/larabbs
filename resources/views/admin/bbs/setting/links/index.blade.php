@extends('admin.layouts.app')

@section('title', '资源推荐')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>资源推荐</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2">
                            <a class="btn btn-primary" href="{{ route('admin.bbs.links.create') }}">新增外链</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(isset($data) && count($data))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>链接</th>
                                    <th>管理</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $item->id or '-' }}</td>
                                        <td>{{ $item->title or '-' }}</td>
                                        <td><a href="{{ $item->link or 'javascript:;' }}" target="_blank">{{ $item->link or '-' }}</a></td>
                                        <td>
                                            <a href="{{ route('admin.bbs.links.edit', [$item->id]) }}"
                                               class="btn btn-info user-edit">编辑</a>
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.bbs.links.destroy', [$item->id]) }}">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {{--{!! $data->render() !!}--}}
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
