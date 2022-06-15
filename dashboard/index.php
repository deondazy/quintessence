<?php

if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$file     = '';
$pageName = 'Overview';

include __DIR__ . '/header.php';

// echo "<script>
// $(function() {
//     var skipModal = getCookie('skipModal');
//     if (!skipModal) { // check and see if a cookie exists indicating we should skip the modal
//         // show your modal here
//         $('#show_notice').click();

//         setCookie('skipModal', 'true', 365*5); // set a cookie indicating we should skip the modal
//     }
// });
// </script>"; 
?>

<style>
    .bg-slate-600 {
        background-color: #ffffff;
        border-color: #dadada;
        color: #333;
    }

    .text-big {
        font-size: 30px;
        font-weight: 300;
    }
</style>

<div class="col-md-12">
    <?php echo Util::flash('success'); ?>
</div>

<?php 
$users = $user->getAll("online = 1");
?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="panel panel-body bg-grey">
                <div class="text-center">
                    <span class="icon-users4 icon-2x mb-5"></span>
                </div>
                <div class="text-center">
                    <h6 class="text-center text-bold"><?php echo count($users); ?> users online</h6>
                </div>
            </div>
        </div>

        <a href="<?php echo $site->url; ?>/dashboard/chat/">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel panel-body border-top-primary border-3">
                    <div class="text-center">
                        <span class="icon-bubbles2 icon-2x mb-5"></span>
                    </div>
                    <div class="text-center">
                        <h6 class="text-center text-bold">Group chat</h6>
                    </div>
                </div>
            </div>
        </a>

        <!-- <a href="#">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel panel-body bg-slate-600">
                    <div class="text-center">
                        <span class="icon-envelop5 icon-2x mb-5"></span>
                    </div>
                    <div class="text-center">
                        <h6 class="text-center text-bold">Messages</h6>
                    </div>
                </div>
            </div>
        </a> -->

        <!-- <a href="#">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel panel-body bg-slate-600">
                    <div class="text-center">
                        <span class="icon-stack-picture icon-2x mb-5"></span>
                    </div>
                    <div class="text-center">
                        <h6 class="text-center text-bold">Gallery</h6>
                    </div>
                </div>
            </div>
        </a> -->

        <a href="<?php echo $site->url; ?>/dashboard/settings/">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel panel-body bg-slate-600">
                    <div class="text-center">
                        <span class="icon-cog2 icon-2x mb-5"></span>
                    </div>
                    <div class="text-center">
                        <h6 class="text-center text-bold">Settings</h6>
                    </div>
                </div>
            </div>
        </a>

        <a href="<?php echo $site->url; ?>/dashboard/auth/logout/">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel panel-body bg-slate-600">
                    <div class="text-center">
                        <span class="icon-switch icon-2x mb-5"></span>
                    </div>
                    <div class="text-center">
                        <h6 class="text-center text-bold">Logout</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
<script src="<?php echo $site->url; ?>/dashboard/assets/js/chat.js"></script>
