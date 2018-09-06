@extends('bbs.layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        @if($topic->id)
                            编辑话题
                        @else
                            新建话题
                        @endif
                    </h2>

                    <hr>

                    @include('bbs.common.error')

                    @if($topic->id)
                        <form action="{{ route('bbs.topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form action="{{ route('bbs.topics.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required/>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="category_id" required>
                                            <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="editor-md">
                                        <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required>{{ old('body', $topic->body ) }}</textarea>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

{{--
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/editor/css/editormd.css') }}">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/editor/editormd.js') }}"></script>
    <script type="text/javascript">
        var myEditor;

        $(function() {
            myEditor = editormd("editor-md", {
                width   : "100%",
                height  : 500,
                syncScrolling : "single",
                path    : "/js/editor/lib/",
                saveHTMLToTextarea : true,

                emoji: true,//emoji表情，默认关闭
                taskList: true,
                tocm: true, // Using [TOCM]
                tex: true,// 开启科学公式TeX语言支持，默认关闭

                flowChart: true,//开启流程图支持，默认关闭
                sequenceDiagram: true,//开启时序/序列图支持，默认关闭,

                dialogLockScreen : false,//设置弹出层对话框不锁屏，全局通用，默认为true
                dialogShowMask : false,//设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                dialogDraggable : false,//设置弹出层对话框不可拖动，全局通用，默认为true
                dialogMaskOpacity : 0.4, //设置透明遮罩层的透明度，全局通用，默认值为0.1
                dialogMaskBgColor : "#fff",//设置透明遮罩层的背景颜色，全局通用，默认为#fff

                codeFold: true,

                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "./upload/index",

                /*上传图片成功后可以做一些自己的处理*/
                onload: function () {
                    //console.log('onload', this);
                    //this.fullscreen();
                    //this.unwatch();
                    //this.watch().fullscreen();
                    //this.width("100%");
                    //this.height(480);
                    //this.resize("100%", 640);
                },

                /**设置主题颜色*/
                editorTheme: "pastel-on-white",
                theme: "white",
                previewTheme: "white"
            });

        });
    </script>
@stop--}}

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/simditor/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor/simditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('bbs.topics.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}' },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>

@stop
