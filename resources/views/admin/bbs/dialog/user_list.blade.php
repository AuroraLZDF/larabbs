<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> - 会员列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="{{ asset('vendor/hAdmin/img/favicon.ico') }}">
    <link href="{{ asset('vendor/hAdmin/css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('vendor/hAdmin/css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">

    <link href="{{ asset('vendor/hAdmin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/hAdmin/css/style.css?v=4.1.0') }}" rel="stylesheet">
    
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <div style="margin: 5px 20px 0 20px;">
        @if(isset($data) && $data)
            <table class="table table-bordered table-hover" style="margin-bottom: auto;">
                <thead>
                <th>选择</th>
                <th>ID</th>
                <th>姓名</th>
                <th>邮箱</th>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                    <tr>
                        <td><input type="radio" name="id" value="{{ $item->id or 0 }}"></td>
                        <td>{{ $item->id or '-'}}</td>
                        <td>{{ $item->name or '-'}}</td>
                        <td>{{ $item->email or '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div> {!! $data->render() !!}</div>
        @else
            ~没有数据
        @endif
    </div>
    <div class="" style="margin: 0 20px 20px 20px;text-align: center;">
        <button type="button" id="closeIframe" class="btn btn-default" style="margin-right: 46px;">Close</button>
        <button type="button" id="submitIframe" class="btn btn-primary">提交</button>
    </div>
</div>

<!-- 全局js -->
<script src="{{ asset('vendor/hAdmin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('vendor/hAdmin/js/bootstrap.min.js?v=3.3.6') }}"></script>
<script type="text/javascript">
    $(function () {
        //注意：parent 是 JS 自带的全局对象，可用于操作父页面
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

        //关闭iframe
        $('#submitIframe').click(function(){
            var val = $('input[name="id"]:checked').val();
            if(val == '' || val == null || val == 'undefined'){
                parent.layer.msg('请选择会员');
                return;
            }

            var name = $('input[name="id"]:checked')
                .parent().parent().children('td').eq(2).text();

            parent.$('input[name="user_id"]').val(val);
            parent.$('#btn_user').text(name);
            parent.layer.msg('您成功选中会员 [ ' + name + ' ] ！');
            parent.layer.close(index);
        });

        $('#closeIframe').click(function () {
            parent.layer.msg('您尚未选择任何会员！');
            parent.layer.close(index);
        });
    });
</script>
</body>
</html>
