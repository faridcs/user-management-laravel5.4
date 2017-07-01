<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item <?php if(strpos(\Request::route()->getName(),'dashboard')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.dashboard.index')); ?>" class="nav-link ">
                        <i class="icon-home"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.dashboard'); ?></span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            <?php if (\Entrust::can('view-users')) : ?>
                <li class="nav-item <?php if(strpos(\Request::route()->getName(),'users')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('user.users.index')); ?>" class="nav-link ">
                        <i class="icon-user"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.users'); ?></span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            <?php endif; // Entrust::can ?>
            <?php if (\Entrust::can(['view-role', 'view-permission'])) : ?>
                <li class="nav-item <?php if(strpos(\Request::route()->getName(),'roles') or strpos(\Request::route()->getName(),'permissions')): ?> active <?php endif; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-key"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.rolesPermissions'); ?></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if (\Entrust::can('view-role')) : ?>
                            <li class="nav-item <?php if(strpos(\Request::route()->getName(),'roles')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('user.roles.index')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.roles'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                        <?php if (\Entrust::can('view-permission')) : ?>
                            <li class="nav-item <?php if(strpos(\Request::route()->getName(),'permissions')): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('user.permissions.index')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.permissions'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                    </ul>
                </li>
            <?php endif; // Entrust::can ?>
            <?php if (\Entrust::can('view-activity-log')) : ?>
                <li class="nav-item <?php if(preg_match('/activity/',\Request::route()->getName())): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('activity')); ?>" class="nav-link ">
                        <i class="icon-clock"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.activityLog'); ?></span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            <?php endif; // Entrust::can ?>
            <?php if (\Entrust::can('view-email-template')) : ?>
                <li class="nav-item <?php if(preg_match('/email-templates/',\Request::route()->getName())): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('email-templates.index')); ?>" class="nav-link ">
                        <i class="icon-envelope"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.emailTemplates'); ?></span>
                        <!-- <span class="selected"></span> -->
                    </a>
                </li>
            <?php endif; // Entrust::can ?>
            <li class="nav-item <?php if(strpos(\Request::route()->getName(),'chat')): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('user-chat')); ?>" class="nav-link ">
                    <i class="fa fa-comments-o"></i>
                    <span class="title"><?php echo app('translator')->getFromJson('menu.userChat'); ?></span>
                    <!-- <span class="selected"></span> -->
                </a>
            </li>
            <?php if($user->user_type=='admin'): ?>
            <li class="nav-item <?php if(preg_match('/session/',\Request::route()->getName())): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('sessions.index')); ?>" class="nav-link ">
                    <i class="fa fa-sign-out"></i>
                    <span class="title"><?php echo app('translator')->getFromJson('menu.session'); ?></span>
                    <!-- <span class="selected"></span> -->
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Entrust::can(['update-social-settings', 'update-general-settings', 'update-theme-settings', 'update-mail-settings', 'update-common-settings', 'manage-custom-fields' ])) : ?>
                <li class="nav-item <?php if(strpos(\Request::route()->getName(),'setting') || strpos(\Request::route()->getName(),'fields')): ?> active <?php endif; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menu.settings'); ?></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if (\Entrust::can('update-social-settings')) : ?>
                            <li class="nav-item <?php if(preg_match('/social/',\Request::route()->getName())): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('social-settings')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.social'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                        <?php if (\Entrust::can('update-general-settings')) : ?>
                            <li class="nav-item <?php if(preg_match('/general/',\Request::route()->getName())): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('general-settings')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.general'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                        <?php if (\Entrust::can('manage-custom-fields')) : ?>
                            <li class="nav-item <?php if(preg_match('/custom-fields/',\Request::route()->getName())): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('custom-fields.index')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.custom_fields'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                        <?php if (\Entrust::can('update-common-settings')) : ?>
                            <li class="nav-item <?php if(preg_match('/common-settings/',\Request::route()->getName())): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('common-settings')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.settings'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                        <?php if (\Entrust::can('update-mail-settings')) : ?>
                            <li class="nav-item <?php if(preg_match('/mail-settings/',\Request::route()->getName())): ?> active <?php endif; ?>">
                                <a href="<?php echo e(route('mail-settings')); ?>" class="nav-link ">
                                    <span class="title"><?php echo app('translator')->getFromJson('menu.mailSettings'); ?></span>
                                </a>
                            </li>
                        <?php endif; // Entrust::can ?>
                    </ul>
                </li>
            <?php endif; // Entrust::can ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>