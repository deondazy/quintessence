<?php
/**
 * Quintessence Fraternity Verification Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../../bootstrap.php';

$page = 'Confirm your registration';

// REDIRECT IF USER IS ALREADY LOGGED
if ($user->isLogged()) {
    Util::redirect($site->url . '/dashboard/');
}

// Verify user
if ("POST" == $_SERVER["REQUEST_METHOD"] && isset($_POST['verify'])) {
    $key = Util::escape($_POST["code"]);

    $verify = $user->activate($key);

    if ($verify) {
        Util::flash('success', 'Your account has been verified, you can login', 'alert alert-success');
        Util::redirect($site->url . '/dashboard/auth/login/');
    }
}

// Resend verification email
if ("POST" == $_SERVER["REQUEST_METHOD"] && isset($_POST['resend_code'])) {
    $email = Util::escape($_POST["email"]);

    $resend = $user->resendActivation($email, true);

    if ($resend) {
        Util::redirect($site->url . '/dashboard/auth/verify/');
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
					<form method="post" class="verify_reg">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-lock2"></i></div>
								<h5 class="content-group">Enter the 6 digit code sent to your email to verify your account.</h5>
								<?php
								if (isset($user->error)) {
									foreach ($user->error as $error) {
										echo "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>{$error}</div>";
									}
								}
								?>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input name="code" type="text" class="form-control" placeholder="Code">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button name="verify" type="submit" class="btn btn-primary btn-block">Verify <i class="icon-circle-right2 position-right"></i></button>
							</div>
                            <hr>
                            <p class="text-center text-muted">Has your verification code expired or you did not get it?</p>
							<div class="form-group">
								<button type="button" class="btn btn-default btn-block js-resend">Resend code</button>
							</div>
						</div>
					</form>
					<!-- /simple login form -->

                    <!-- Simple login form -->
					<form method="post" class="hidden_form resend_code">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-envelop"></i></div>
								<h5 class="content-group">Enter your registered email to resend verification code.</h5>
								<?php
								if (isset($user->error)) {
									foreach ($user->error as $error) {
										echo "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>{$error}</div>";
									}
								}
								?>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input name="email" type="email" class="form-control" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-envelop text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button name="resend_code" type="submit" class="btn btn-primary btn-block">Resend verification code <i class="icon-circle-right2 position-right"></i></button>
							</div>
						</div>
					</form>
					<!-- /simple login form -->

                    <style>
                        .hidden_form {
                            display: none;
                        }
                    </style>

                    <script>
                        $(document).ready(function() {
                            $('.js-resend').click(function(event) {
                                event.preventDefault();
                                $('.resend_code').removeClass('hidden_form');
                                $('.verify_reg').addClass('hidden_form');
                            });
                        });
                    </script>


					<?php include __DIR__ . '/footer.php'; ?>