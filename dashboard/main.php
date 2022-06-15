<?php
/**
 * Quintessence Fraternity Dashboard Overview Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$page = 'Overview';

include __DIR__ . '/header.php'; ?>

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Secondary sidebar -->
        <div class="sidebar sidebar-secondary sidebar-default">
            <div class="sidebar-content">

                <!-- Online users -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Online users</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content no-padding">
                        <ul class="media-list media-list-linked" id="users-list">
                            
                        </ul>
                    </div>
                </div>
                <!-- /online users -->

            </div>
        </div>
        <!-- /secondary sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Line content divider -->
            <div class="panel panel-flat">
                <div class="panel-body">

                </div>
            </div>
            <!-- /line content divider -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<?php include __DIR__ . '/footer.php'; ?>