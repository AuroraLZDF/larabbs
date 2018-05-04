@extends('admin.layouts.app')

@section('title', '会员列表')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>话题列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row  m-b-xs">
                        <form action="{{ route('admin.bbs.topics.index') }}" method="get">
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
                                           placeholder="请输入作者" class="input-sm form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <select name="category" class="input-sm form-control input-s-sm inline">
                                    <option value="">— 请选择分类 —</option>
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $category->id }}"
                                                @if(isset($params['category']) && $params['category'] == $category->id) selected @endif>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                 <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        @if(isset($topics) && count($topics))
                            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>话题</th>
                                    <th>作者</th>
                                    <th>分类</th>
                                    <th>评论</th>
                                    <th>创建时间</th>
                                    <th>管理</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($topics as $key => $topic)
                                    <tr>
                                        <td>{{ $topic->id or '-' }}</td>
                                        <td><a href="{{ route('bbs.topics.show', ['topic' => $topic]) }}" target="_blank">{{ $topic->title or '-' }}</a></td>
                                        <td><a href="{{ route('admin.bbs.users.index', ['type' => 1, 'value' => $topic->user->id]) }}">{{ $topic->user->name or '-' }}</a></td>
                                        <td>{{ $topic->category->name or '-' }}</td>
                                        <td>{{ $topic->reply_count or '-' }}</td>
                                        <td>{{ $topic->created_at or '-' }}</td>
                                        <td>
                                            @if($topic->status == 2)
                                                <button class="btn btn-warning diy-warning"
                                                        data-url="{{ route('admin.bbs.topics.update', [$topic->id]) }}"
                                                        data-status="1">恢复访问</button>
                                            @else
                                                <button class="btn btn-info diy-warning"
                                                        data-url="{{ route('admin.bbs.topics.update', [$topic->id]) }}"
                                                        data-status="2">禁止访问</button>
                                            @endif
                                            <button type="button" class="btn btn-danger btn-warning diy-delete"
                                                    data-url="{{ route('admin.bbs.topics.destroy', [$topic->id]) }}">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div> {{-- 分页 --}}
                                {!! $topics->render() !!}
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
