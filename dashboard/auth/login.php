<?php
/**
 * Quintessence Fraternity Login Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../../bootstrap.php';

$page = 'Login';

// REDIRECT IF USER IS ALREADY LOGGED
if ($user->isLogged()) {
    Util::redirect($site->url . '/dashboard/');
}

if ("POST" == $_SERVER["REQUEST_METHOD"]) {
    $email = Util::escape($_POST["email"]);
    $password = trim($_POST["password"]);

    $login = $user->login($email, $password);

    if ($login) {
        $user->addCookie($login["hash"], $login["expire"]);

        // Redirect after login
        $refurl = isset($_GET['refurl']) ? $site->url . Util::escape($_GET['refurl']) : $site->url . '/dashboard/';

        Util::redirect($refurl);
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
								<h5 class="content-group">Login to your account</h5>
								<?php
								Util::flash('logout');
								
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

							<div class="form-group has-feedback has-feedback-left">
								<input name="password" type="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<a href="<?php echo $site->url; ?>/dashboard/auth/forgot-password/">Forgot password?</a>
							</div>
							<div class="text-center">
								Do not have an account? <a href="<?php echo $site->url; ?>/dashboard/auth/register/">Register</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<?php include __DIR__ . '/footer.php'; ?>