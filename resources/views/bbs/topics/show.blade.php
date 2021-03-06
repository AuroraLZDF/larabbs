@extends('bbs.layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        作者：{{ $topic->user->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="{{ route('bbs.users.show', $topic->user->id) }}">
                                <img class="thumbnail img-responsive" src="{{ $topic->user->avatar }}" width="300px" height="300px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ $topic->title }}
                    </h1>

                    <div class="article-meta text-center">
                        {{ $topic->created_at->diffForHumans() }}
                        ⋅
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        {{ $topic->reply_count }}
                    </div>

                    <div class="topic-body">
                        {!! $topic->body !!}
                    </div>

                    {{--@can('update', $topic->user)--}}
                    @if(App\Http\Controllers\Bbs\BaseController::authCheck($topic->user))
                        <div class="operate">
                            <hr>
                            <a href="{{ route('bbs.topics.edit', $topic->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                                <i class="glyphicon glyphicon-edit"></i> 编辑
                            </a>

                            <form action="{{ route('bbs.topics.destroy', $topic->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    删除
                                </button>
                            </form>
                        </div>
                    @endif
                    {{--@endcan--}}

                </div>
            </div>

            {{-- 用户回复列表 --}}
            <div class="panel panel-default topic-reply">
                <div class="panel-body">
                    @includeWhen(auth('bbs')->check(), 'bbs.topics._reply_box', ['topic' => $topic])
                    @include('bbs.topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
                </div>
            </div>
        </div>
    </div>
@stop
@section('styles')
    <link href="{{ asset('js/atwho/jquery.atwho.min.css') }}" rel="stylesheet">
@stop
@section('scripts')
    <script src="{{ asset('js/atwho/jquery.caret.min.js') }}"></script>
    <script src="{{ asset('js/atwho/jquery.atwho.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#inputor').atwho({
                at: "@",
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("{{ route('bbs.users_json') }}", {q: query}, function(data) {
                            callback(data)
                        });
                    }
                }
            });
        });
    </script>
@stop
