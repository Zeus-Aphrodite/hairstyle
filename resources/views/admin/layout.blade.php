<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Quiz app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="{{ \asset('css/admin/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ \asset('css/admin/libs.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ \asset('css/admin/admin.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="">

<div class="header navbar navbar-inverse ">

    <div class="navbar-inner">
        <div class="header-quick-nav">

            <div class="pull-left">
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" id="layout-condensed-toggle">
                            <i class="material-icons">menu</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="notification-list" style="display:none">
                <div style="width:300px">
                    <div class="notification-messages info">
                        There are no notifications yet
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <ul class="nav quick-section ">
                    <li class="quicklinks">
                        <a href="#"
                            class=""
                            id="my-task-list"
                            data-placement="bottom"
                            data-content=''
                            data-toggle="dropdown"
                            data-original-title="Notifications">
                            <i class="material-icons">notifications_none</i>
                        </a>
                    </li>

                    <li class="quicklinks"><span class="h-seperate"></span></li>
                    <li class="quicklinks">
                        <a data-toggle="dropdown"
                            class="dropdown-toggle pull-right "
                            href="#"
                            id="user-options">
                            <i class="material-icons">tune</i>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                            <li><a href="{{ \route('admin.profile.edit') }}">My Profile</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ \route('admin.logout') }}">
                                    <i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>


<div class="page-container row-fluid">

    <div class="page-sidebar" id="main-menu">

        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
            <ul>
                <li class="{{ \Route::is('admin.homepage') ? 'active' : '' }}">
                    <a href="{{ \route('admin.homepage') }}">
                        <i class="material-icons">playlist_add_check</i>
                        <span class="title">Quiz Statistics</span>
                    </a>
                </li>

                <li class="{{ \Route::is('admin.selections') ? 'active' : '' }}">
                    <a href="{{ \route('admin.selections') }}">
                        <i class="material-icons">playlist_add_check</i>
                        <span class="title">Selection Statistics</span>
                    </a>
                </li>

                <li class="{{ \Route::is('admin.haircuts*') ? 'active' : '' }}">
                    <a href="{{ \route('admin.haircuts.index') }}">
                        <i class="material-icons">invert_colors</i>
                        <span class="title">Haircuts</span>
                    </a>
                </li>

                <li class="{{ \Route::is('admin.packed-haircuts*') ? 'active' : '' }}">
                    <a href="{{ \route('admin.packed-haircuts.index') }}">
                        <i class="material-icons">invert_colors</i>
                        <span class="title">Packed Haircuts</span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>

        </div>
    </div>


    <div class="page-content">
        <div class="clearfix"></div>
        <div class="content">
            @if ($message = \Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

</div>

<script src="{{ \asset('js/admin/libs.js') }}" type="text/javascript"></script>
@yield('scripts')

</body>
</html>
