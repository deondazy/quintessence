<div class="col-md-12">
    <!-- Footer -->
    <div class="text-muted text-center">
        <hr>
        &copy; <?php echo date('Y'); ?> <?php echo $site->name; ?>. All Rights Reserved.
    </div>
<!-- /footer -->
</div>

</div><!-- /.row -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->

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
                <span class="text-bold">Users</span>
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

</div>
<!-- /page content -->

</div>
<!-- /page container -->

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
                url: '<?php echo $site->url; ?>/dashboard/update-online-activity.php',
                method: 'post',
                success: function(data) {
                    // Nothing to do here...
                }
            })
        }

        function getUsers() {
            $.ajax({
                url: '<?php echo $site->url; ?>/dashboard/get-users.php',
                method: 'post',
                success: function(data) {
                    $('#users-list').html(data);
                }
            })
        }
    })
</script>
</body>
</html>
