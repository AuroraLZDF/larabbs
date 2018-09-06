@extends('admin.layouts.app')

@section('title', '会员列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                        <form action="{{ route('admin.bbs.categories.index') }}" method="get">
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
                                           placeholder="请输入分类名称" class="input-sm form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </form>
                        <div class="col-sm-5">
                                 <span class="input-group-btn" style="float: right;">
                                    <a href="{{ route('admin.bbs.categories.create') }}" class="btn btn-sm btn-primary"> 新增分类</a>
                                </span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        @if(isset($categories) && count($categories))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>描述</th>
                                    <th>创建时间</th>
                                    <th>管理</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $category->id or '-' }}</td>
                                        <td>{{ $category->name or '-' }}</td>
                                        <td>{{ $category->description or '-' }}</td>
                                        <td>{{ $category->created_at or '-' }}</td>
                                        <td>
                                            <a class="btn btn-info " href="{{ route('admin.bbs.categories.edit', [$category->id]) }}">编辑</a>
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.bbs.categories.destroy', [$category->id]) }}">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {!! $categories->render() !!}
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
@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.diy-warning').click(function () {
                var url = $(this).data('url');
                var status = $(this).data('status');

                swal({
                    title: "您确定要关闭篇话题内容吗？",
                    text: "禁止后用户将无法浏览该篇文章，请谨慎操作！",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        data: {
                            status: status
                        },
                        type: 'PUT',
                        dataType: 'json',
                        success: function (data) {
                            if (data.code == 1) {
                                swal("审核成功！", data.message, "success");
                                //额外绑定一个事件，当确定执行之后返回成功的页面的确定按钮，
                                // 点击之后刷新当前页面或者跳转其他页面
                                $('.confirm').click(function () {
                                    location.reload();
                                });
                            } else {
                                swal("审核失败！", data.message, "error");
                                $('.confirm').click(function () {
                                    //location.reload();
                                    return false;
                                });
                            }
                        }
                    });
                });
            });
        });
    </script>
@stop
