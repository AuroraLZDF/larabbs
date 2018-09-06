@extends('admin.layouts.app')

@section('title', '权限列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>权限列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                        <div class="col-sm-1">
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">添加权限</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(isset($permissions) && count($permissions))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>guard</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>编辑</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ $permission->id or '-' }}</td>
                                        <td>{{ $permission->name or '-' }}</td>
                                        <td>{{ $permission->guard_name or '-' }}</td>
                                        <td>{{ $permission->created_at or '-' }}</td>
                                        <td>{{ $permission->updated_at or '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.permissions.edit', [$permission->id]) }}" class="btn btn-info" >编辑</a>
                                            {{--<button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.permissions.destroy', [$permission->id]) }}"
                                                    data-json='{"_token": "{{ csrf_token() }}", "_method": "DELETE"}'>删除</button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {!! $permissions->render() !!}
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
