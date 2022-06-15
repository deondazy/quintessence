<?php
/**
 * Quintessence Fraternity Profile Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$file = 'settings/';
$pageName = 'Settings';

$chat = new QF\Core\Chat;
$chats = $chat->getAll();

$uid = $user->currentUserId();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $phone = isset($_POST['phone']) ? Util::escape($_POST['phone']) : $user->get('phone', $uid);
    $first_name = isset($_POST['first_name']) ? Util::escape($_POST['first_name']) : $user->get('first_name', $uid);
    $last_name = isset($_POST['last_name']) ? Util::escape($_POST['last_name']) : $user->get('last_name', $uid);

    $data = [
        'phone'      => $phone,
        'first_name' => $first_name,
        'last_name'  => $last_name,
    ];
    
    if (isset($_FILES['avatar'])) {
        // Avatar
        $upload_time = date('YmdHis').'_';
        $upload_dir  = __DIR__ . '/uploads/avatar/';
        $upload_file = $upload_dir . basename($upload_time . $_FILES['avatar']['name']);

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
            $data['avatar'] = $site->url . '/dashboard/uploads/avatar/' . $upload_time . $_FILES['avatar']['name'];
        }
    }

    if ($user->update($data, $uid)) {
        Util::flash('save_success', 'Settings saved');
        Util::redirect($site->url . '/dashboard/settings');
    } else {
        if (!empty($user->error)) {
            foreach ($user->error as $error) {
                Util::flash('save_error', $error, 'alert alert-danger');
                Util::redirect($site->url . '/dashboard/settings/');
            }
        }
        
        Util::flash('save_error', 'Unable to save, please try again', 'alert alert-danger');
        Util::redirect($site->url . '/dashboard/settings/');
    }
}

include __DIR__ . '/header.php'; ?>

<!-- <style>
    .panel {
        border-top: none;
    }

    .sidebar {
        display: table-cell;
        height: 100%;
        width: 100%;
    }

    .profile-picture {
        text-align: center;
    }

    .profile-picture img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
    }

    .profile-name {
        text-align: center;
        font-weight: 700;
    }

    .profile-name h3 {
        margin: 0;
    }

    #user-avatar {
        cursor: pointer;
        width: 150px;
        height: 150px;
    }

    .btn-file {
        height: 150px;
        width: 150px;
        overflow: visible;
    }

    .category-content {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 40px;
    }

    .help-block {
        cursor: default;
    }

    .footer {
        position: relative;
    }
</style> -->

<div class="panel panel-body">
    <?php Util::flash('save_success'); ?>
    <?php Util::flash('save_error'); ?>

    <form method="post" enctype="multipart/form-data">

        <!-- Page content -->
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input required type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="First Name" value="<?php echo $user->get('first_name', $uid); ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input required type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Last Name" value="<?php echo $user->get('last_name', $uid); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div disabled id="email" class="form-control"><?php echo $user->get('email', $uid); ?></div>
                            <span class="help-block">Email address can not be changed.</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input required type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number"
                                value="<?php echo $user->get('phone', $uid); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-content no-padding text-center">
                    <div tabindex="500" class="btn-file">
                        <div class="profile-picture" id="show-avatar">
                            <img width="100" height="100" class="img-circle"
                                src="<?php echo $user->getProfilePicture($uid); ?>" />
                        </div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="‪5242880‬">

                        <div id="response"></div>

                        <input id="user-avatar" name="avatar" type="file" class="file-input-custom"
                            data-show-caption="true" data-show-upload="true" accept="image/*">
                        <div class="help-block">Click image to change</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /page content -->

        <div class="row">
            <div class="col-md-12">
                <button id="save" type="submit" class="btn btn-primary btn-labeled btn-labeled-right"><b><i class="icon-floppy-disk"></i></b> Save changes</button>
            </div>
        </div>

    </form>

</div>
<?php include __DIR__ . '/footer.php'; ?>

<script>
    $(document).ready(function () {
        var input = document.getElementById("user-avatar"),
            formdata = false;

        if (window.FormData) {
            formdata = new FormData();
        }

        // Show the uploaded image
        function showUploadedItem(source) {
            var display = document.getElementById("show-avatar"),
                img = document.createElement("img");
            img.src = source;
            display.innerHTML = "";
            display.appendChild(img);
        }

        if (input.addEventListener) {
            input.addEventListener("change", function (evt) {
                var img,
                    reader,
                    file;
                file = this.files[0];

                if (!file.type.match(/image.*/)) {
                    document.getElementById("show-avatar").innerHTML = "";
                    document.getElementById("response").innerHTML = "That's not an image";
                    return;
                } else {
                    document.getElementById("response").innerHTML = "";
                }

                if (window.FileReader) {
                    reader = new FileReader();

                    reader.onloadend = function (e) {
                        showUploadedItem(e.target.result);
                    };

                    reader.readAsDataURL(file);
                }
            }, false);
        }
    });
</script>