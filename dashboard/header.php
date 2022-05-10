<?php 
if (!$user->isLogged()) {
    QF\Core\Util::redirect($site->url . '/dashboard/auth/login/?refurl=' . urlencode($_SERVER['REQUEST_URI']));
}

function isActive($pageName)
{
    global $page;

    return ($pageName == $page) ? 'class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site->name; ?> - <?php echo $page; ?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="<?php echo $site->url; ?>/dashboard/global_assets/css/icons/icomoon/styles.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo $site->url; ?>/dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $site->url; ?>/dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $site->url; ?>/dashboard/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $site->url; ?>/dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo $site->url; ?>/dashboard/assets/js/app.js"></script>
    <script src="<?php echo $site->url; ?>/dashboard/global_assets/js/demo_pages/chat_layouts.js"></script>
    <!-- /theme JS files -->

</head>

<style>
    .navbar-nav>.dropdown-user img {
        height: 30px;
        width: 30px;
    }

    .nav .active a::before {
        border-top: 1px solid #333;
        content: '';
        position: absolute;
        top: -1px;
        z-index: 9;
        width: 100%;
        overflow: hidden;
        left: 0;
    }

    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.active>a:focus,
    .navbar-default .navbar-nav>.active>a:hover {
        background-color: #333;
        color: #f8f8f8;
    }
    .navbar-brand {
        padding-top: 0;
    }
</style>

<body class="sidebar-xs">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo $site->url; ?>/dashboard/">
                <h1 style="margin:0;">LOGO</h1>
            </a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-secondary-toggle"><i class="icon-grid3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">

            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <?php if (empty($user->get('avatar', $user->currentUserId()))) : ?>
                        <img
                            src="https://ui-avatars.com/api/?name=<?php echo ucfirst($user->get('first_name', $user->currentUserId())); ?>+<?php echo ucfirst($user->get('last_name', $user->currentUserId())); ?>&font-size=0.33">
                        <?php else : ?>
                        <img src="<?php echo $user->get('avatar', $user->currentUserId()); ?>">
                        <?php endif; ?>

                        <span><?php echo ucfirst($user->get('first_name', $user->currentUserId())); ?>
                            <?php echo ucfirst($user->get('last_name', $user->currentUserId())); ?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?php echo $site->url; ?>/dashboard/profile/"><i class="icon-user-plus"></i> My
                                profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $site->url; ?>/dashboard/auth/logout/"><i class="icon-switch2"></i>
                                Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Second navbar -->
    <div class="navbar navbar-default" id="navbar-second">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                        class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li <?php echo isActive('Chat'); ?>>
                    <a href="<?php echo $site->url; ?>/dashboard/">
                        <i class="icon-bubbles2 position-left"></i> Chat
                    </a>
                </li>

                <li <?php echo isActive('Profile'); ?>>
                    <a href="<?php echo $site->url; ?>/dashboard/profile/">
                        <i class="icon-user position-left"></i> Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /second navbar -->