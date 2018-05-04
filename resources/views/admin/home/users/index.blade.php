@extends('admin.layouts.app')

@section('title', '管理员列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>管理员列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                       <div class="col-sm-1">
                           <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">添加管理员</a>
                       </div>
                    </div>
                    <div class="table-responsive">
                        @if(isset($users) && count($users))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
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
                                        <td>{{ $user->created_at or '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', [$user->id]) }}" class="btn btn-info user-edit" >编辑</a>
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.users.destroy', [$user->id]) }}"
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
        th, td {
            text-align: center;
        }

        img {
            width: 40px;
            height: 40px;
        }
    </style>
@stop
