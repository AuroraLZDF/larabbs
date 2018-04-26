<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <form action="{{ route('admin.logout') }}" method="post" id="logout-form">
                                {{ csrf_field() }}
                                <span class="block m-t-xs" style="font-size:20px;">
                                    <i class="glyphicon glyphicon-off" id="logout"></i>
                                    <strong class="font-bold">{{ auth('admin')->user()->name }}</strong>
                                </span>
                                <script type="text/javascript">
                                    document.getElementById("logout").onclick = function(){
                                        document.getElementById('logout-form').submit();
                                    };
                                </script>
                            </form>
                        </span>
                    </a>
                </div>
                <div class="logo-element">{{ auth('admin')->user()->name }}</div>
            </li>

            <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span class="ng-scope">分类</span>
            </li>

            <li>
                <a class="J_menuItem" href="{{ route('admin.root') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">主页</span>
                </a>
            </li>
            @if(App\Http\Controllers\Admin\BaseController::permissions(auth('admin')->user(), 'edit_settings'))
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-th"></i>
                    <span class="nav-label">后台管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="{{ route('admin.users.index') }}">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="nav-label">管理员管理</span>
                        </a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="#">角色管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="#">权限管理</a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span class="nav-label">论坛模块</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    @if(App\Http\Controllers\Admin\BaseController::permissions(auth('admin')->user(), 'manage_users'))
                    <li>
                        <a href="#">用户与权限 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.users.index') }}">会员管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="#">角色管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="#">权限管理</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(App\Http\Controllers\Admin\BaseController::permissions(auth('admin')->user(), 'manage_contents'))
                    <li>
                        <a href="#">内容管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.categories.index') }}">分类管理</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.topics.index') }}">话题列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.replies.index') }}">回复列表</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(App\Http\Controllers\Admin\BaseController::permissions(auth('admin')->user(), 'edit_settings'))
                    <li>
                        <a href="#">站点管理 <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.site') }}">全局设着</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="{{ route('admin.bbs.links.index') }}">外链管理</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="line dk"></li>
        </ul>
    </div>
</nav>