<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item @if(strpos(\Request::route()->getName(),'dashboard')) active @endif">
                    <a href="{{ route('user.dashboard.index') }}" class="nav-link ">
                        <i class="icon-home"></i>
                        <span class="title">@lang('menu.dashboard')</span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            @permission('view-users')
                <li class="nav-item @if(strpos(\Request::route()->getName(),'users')) active @endif">
                    <a href="{{ route('user.users.index') }}" class="nav-link ">
                        <i class="icon-user"></i>
                        <span class="title">@lang('menu.users')</span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            @endpermission
            @permission(['view-role', 'view-permission'])
                <li class="nav-item @if(strpos(\Request::route()->getName(),'roles') or strpos(\Request::route()->getName(),'permissions')) active @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-key"></i>
                        <span class="title">@lang('menu.rolesPermissions')</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @permission('view-role')
                            <li class="nav-item @if(strpos(\Request::route()->getName(),'roles')) active @endif">
                                <a href="{{ route('user.roles.index') }}" class="nav-link ">
                                    <span class="title">@lang('menu.roles')</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('view-permission')
                            <li class="nav-item @if(strpos(\Request::route()->getName(),'permissions')) active @endif">
                                <a href="{{ route('user.permissions.index') }}" class="nav-link ">
                                    <span class="title">@lang('menu.permissions')</span>
                                </a>
                            </li>
                        @endpermission
                    </ul>
                </li>
            @endpermission
            @permission('view-activity-log')
                <li class="nav-item @if(preg_match('/activity/',\Request::route()->getName())) active @endif">
                    <a href="{{ route('activity') }}" class="nav-link ">
                        <i class="icon-clock"></i>
                        <span class="title">@lang('menu.activityLog')</span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            @endpermission
            @permission('view-email-template')
                <li class="nav-item @if(preg_match('/email-templates/',\Request::route()->getName())) active @endif">
                    <a href="{{ route('email-templates.index') }}" class="nav-link ">
                        <i class="icon-envelope"></i>
                        <span class="title">@lang('menu.emailTemplates')</span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            @endpermission
            <li class="nav-item @if(strpos(\Request::route()->getName(),'chat')) active @endif">
                <a href="{{ route('user-chat') }}" class="nav-link ">
                    <i class="fa fa-comments-o"></i>
                    <span class="title">@lang('menu.userChat')</span>
                    <!-- <span class="selected"></span> -->
                </a>
            </li>
            @if($user->user_type=='admin')
            <li class="nav-item @if(preg_match('/session/',\Request::route()->getName())) active @endif">
                <a href="{{ route('sessions.index') }}" class="nav-link ">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">@lang('menu.session')</span>
                    <!-- <span class="selected"></span> -->
                </a>
            </li>
            @endif
            @permission(['update-social-settings', 'update-general-settings', 'update-theme-settings', 'update-mail-settings', 'update-common-settings', 'manage-custom-fields' ])
                <li class="nav-item @if(strpos(\Request::route()->getName(),'setting') || strpos(\Request::route()->getName(),'fields')) active @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">@lang('menu.settings')</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @permission('update-social-settings')
                            <li class="nav-item @if(preg_match('/social/',\Request::route()->getName())) active @endif">
                                <a href="{{route('social-settings')}}" class="nav-link ">
                                    <span class="title">@lang('menu.social')</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('update-general-settings')
                            <li class="nav-item @if(preg_match('/general/',\Request::route()->getName())) active @endif">
                                <a href="{{ route('general-settings') }}" class="nav-link ">
                                    <span class="title">@lang('menu.general')</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('manage-custom-fields')
                            <li class="nav-item @if(preg_match('/custom-fields/',\Request::route()->getName())) active @endif">
                                <a href="{{ route('custom-fields.index') }}" class="nav-link ">
                                    <span class="title">@lang('menu.custom_fields')</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('update-common-settings')
                            <li class="nav-item @if(preg_match('/common-settings/',\Request::route()->getName())) active @endif">
                                <a href="{{ route('common-settings') }}" class="nav-link ">
                                    <span class="title">@lang('menu.settings')</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('update-mail-settings')
                            <li class="nav-item @if(preg_match('/mail-settings/',\Request::route()->getName())) active @endif">
                                <a href="{{ route('mail-settings') }}" class="nav-link ">
                                    <span class="title">@lang('menu.mailSettings')</span>
                                </a>
                            </li>
                        @endpermission
                    </ul>
                </li>
            @endpermission
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>