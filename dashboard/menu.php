<?php

/**
 * Member Menu array
 *
 * 0: Name of the menu item
 * 1: Filename of the menu item
 * 2: Icon for the menu item
 */

$memberMenu[1] = ['Overview', '', 'icon-meter-fast'];
$memberMenu[2] = ['Group chat', 'chat/', 'icon-bubbles2'];
// $memberMenu[3] = ['Messages', 'messages/', 'icon-envelop5'];
// $memberMenu[4] = ['Gallery', 'gallery/', 'icon-stack-picture'];
$memberMenu[5] = ['Settings', 'settings/', 'icon-cog2'];
?>

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <div class="media-body">
                        <div class="sidebar-avatar pull-left">
                            <?php if (empty($user->get('avatar', $user->currentUserId()))) : ?>
                                <img width="45" class="img-circle" src="https://ui-avatars.com/api/?name=<?php echo ucfirst($user->get('first_name', $user->currentUserId())); ?>+<?php echo ucfirst($user->get('last_name', $user->currentUserId())); ?>&font-size=0.33">
                            <?php else : ?>
                                <img width="50" height="50" class="img-circle" src="<?php echo $user->get('avatar', $user->currentUserId()); ?>" style="height:50px;width:50px;">
                            <?php endif; ?>
                        </div>

                        <div style="float: left;padding-left: 10px;padding-top:0;">
                            <div style="font-size:16px;" class="sidebar-name text-bold"><?php echo ucfirst($user->get('first_name', $user->currentUserId())); ?> <?php echo ucfirst($user->get('last_name', $user->currentUserId())); ?></div>
                            <small class="sidebar-email text-muted"><?php echo $user->get('email', $user->currentUserId()); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Menu start -->
                    <?php
                    $url = $site->url . '/dashboard/';
                    foreach ($memberMenu as $menu) {
                        if ($file == $menu[1]) {
                            echo "<li class=\"active\">";
                        } else {
                            echo "<li>";
                        }
                        echo "<a href=\"{$url}{$menu[1]}\">";
                        echo "<i class=\"{$menu[2]}\"></i> <span>{$menu[0]}</span>";
                        echo  "</a>";
                        echo "</li>";
                    }
                    ?>
                    <!-- Menu end -->

                    <?php echo "<li><a href=\"{$url}auth/logout/\"><i class=\"icon-switch\"></i> <span>Logout</span></a></li>";
                    ?>
                    <!-- /main -->
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->
