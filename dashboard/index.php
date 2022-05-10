<?php
/**
 * Quintessence Fraternity Chat Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$page = 'Chat';

$chat = new QF\Core\Chat;
$chats = $chat->getAll();



include __DIR__ . '/header.php'; ?>
<style>
    .bottom-message-box {
        position: fixed;
        bottom: -20px;
        width: 100%;
        z-index: 999;
        left: 0;
        right: 0;
    }

    .chat-list {
        margin-bottom: 170px !important;
    }
    .madia-user {
        font-weight: 700;
        color: #C62828;
    }
</style>

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Secondary sidebar -->
        <div class="sidebar sidebar-secondary sidebar-default">
            <div class="sidebar-content">


                <!-- Search messages -->
                <!--<div class="sidebar-category">
                        <div class="category-title">
                            <span>Search messages</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content">
                            <form action="#">
                                <div class="has-feedback has-feedback-left">
                                    <input type="search" class="form-control" placeholder="Type and hit Enter">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4 text-size-base text-muted"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>-->
                <!-- /search messages -->


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
                    <ul class="media-list chat-list content-group" id="chatwindow">

                    </ul>

                    <form method="post" class="typing-area">
                        <input type="text" value="<?php echo $user->currentUserId(); ?>" class="incoming_id" name="incoming_id" hidden>
                        <div class="bottom-message-box panel panel-body">
                            <textarea id="message" name="message" class="form-control content-group input-field" rows="3" cols="1"
                                placeholder="Enter your message..."></textarea>

                            <div class="row">
                                <div class="col-xs-6">
                                </div>

                                <div class="col-xs-6 text-right">
                                    <button id="sendchat" type="submit" class="btn btn-primary btn-labeled btn-labeled-right"><b><i
                                                class="icon-circle-right2"></i></b> Send</button>
                                </div>
                            </div>
                        </div>
                    </form>

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

<!--<script>
    $(document).ready(function() {
        $('#sendchat').click(function(e) {
            e.preventDefault();

            var message = $('#message').val();

            $.post("send-chat.php",
            {
                message: message,
            },
            function(data, status){
                //
            });
        });

        setInterval(() => {
            loadChat();
        }, 2000);

        function loadChat()
        {
            $.ajax({
                method: "post",
                url: "get-chat.php",
                success: function(data) {
                    $('#chatwindow').html(data);
                }
            });
        }
    })
</script>-->

<script src="<?php echo $site->url; ?>/dashboard/assets/js/chat.js"></script>
<script>
    $(document).ready(function() {
        setInterval(() => {
            updateOnlineActivity();
            getUsers();
        }, 5000);

        /*setInterval(() => {
            getUsers();
        }, 10000);*/

        function updateOnlineActivity() {
            $.ajax({
                url: 'update-online-activity.php',
                method: 'post',
                success: function(data) {
                    // Nothing to do here...
                }
            })
        }

        function getUsers() {
            $.ajax({
                url: 'get-users.php',
                method: 'post',
                success: function(data) {
                    $('#users-list').html(data);
                }
            })
        }
    })
</script>