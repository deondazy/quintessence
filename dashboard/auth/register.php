<?php
/**
 * Quintessence Fraternity Register Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../../bootstrap.php';

$page = 'Create New Account';

// REDIRECT IF USER IS ALREADY LOGGED
if ($user->isLogged()) {
    Util::redirect($site->url . '/dashboard/');
}

// DO SIGN UP
if ("POST" == $_SERVER["REQUEST_METHOD"]) {
    $firstName      = Util::escape($_POST['first_name']);
    $lastName       = Util::escape($_POST['last_name']);
    $email          = Util::escape($_POST["email"]);
    $phone          = Util::escape($_POST["phone_number"]);
    $password       = trim($_POST["password"]);
    $timeNow        = time();
    
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
        Util::flash('error', 'All fields are required', 'alert alert-danger alert-styled-left');
        Util::redirect($site->url . '/dashboard/auth/register/');
    }
    
    

    $register = $user->register($email, $password, [
        "register_date" => $timeNow, 
        "first_name"    => $firstName, 
        "last_name"     => $lastName,
        "phone"         => $phone,
        "last_login"    => time(),
    ]);

    if ($register) {
        // TODO: Send Email Verification
        
        $user->addCookie($register["hash"], $register["expire"]);

        Util::redirect($site->url . '/dashboard/');
    } else {
        if (!empty($user->error)) {
            foreach ($user->error as $error) {
                Util::flash('error', $error, 'alert alert-danger alert-styled-left');
            Util::redirect($site->url . '/dashboard/auth/register/');
            }
        }
        Util::flash('error', 'Unable to register. Please, try again.', 'alert alert-danger alert-styled-left');
        Util::redirect($site->url . '/dashboard/auth/register/');
    }
}

include __DIR__ . '/header.php';
?>


<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content">

            <!-- Simple login form -->
            <form method="post">
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        <h5 class="content-group">Create New Account</h5>
                        <?php echo Util::flash('error'); ?>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input required name="first_name" type="text" class="form-control" placeholder="First Name" <?php echo Util::fill('first_name'); ?>>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input required name="last_name" type="text" class="form-control" placeholder="Last Name">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input required name="email" type="email" class="form-control" placeholder="Email">
                        <div class="form-control-feedback">
                            <i class="icon-envelop text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input required name="phone_number" type="tel" class="form-control" placeholder="Phone Number">
                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input required name="password" type="password" class="form-control" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Create New Account <i class="icon-circle-right2 position-right"></i></button>
                    </div>

                    <div class="text-center">
                        Already have an account? <a href="<?php echo $site->url; ?>/dashboard/auth/login/">Login</a>
                    </div>
                </div>
            </form>
            <!-- /simple login form -->


            <?php include __DIR__ . '/footer.php'; ?>