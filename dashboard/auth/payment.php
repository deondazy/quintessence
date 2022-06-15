<?php
/**
 * Quintessence Fraternity Payment Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;
use Matscode\Paystack\Transaction;
use Matscode\Paystack\Utility\Debug; // for Debugging purpose
use Matscode\Paystack\Utility\Http;

require __DIR__ . '/../../bootstrap.php';

$page = 'Login';

// REDIRECT IF USER IS ALREADY LOGGED
if ($user->get('paid', $user->currentUserId())) {
    Util::redirect($site->url . '/dashboard/');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // TODO: Remove this line
    //Util::redirect($site->url . '/dashboard/auth/payment/');

    // Pay 25k
    $email = $user->get('email', $user->currentUserId());
    $secretKey = $config->payment->paystack_api_test_key;

    // creating the transaction object
    $Transaction = new Transaction($secretKey);

    // Set data to post using this method
    $response = $Transaction
                ->setCallbackUrl('https://quintessence.dev:8890/dashboard/auth/payment-callback.php')
                ->setEmail($email)
                ->setAmount(25000) // amount is treated in Naira while using this method
                ->initialize([], true);

    var_dump($response);

    // recommend to save Transaction reference in database and do a redirect
    $reference = $response->data->reference;

    if ($user->update(['payment_ref' => $reference], $user->currentUserId())) {
        // redirect
        Http::redirect($response->data->authorization_url);
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
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-credit-card2"></i></div>
								<h5 class="content-group">Make payment to access the dashboard</h5>
							</div>


							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Pay ₦25,000.00 <i class="icon-circle-right2 position-right"></i></button>
							</div>

						</div>
					</form>
					<!-- /simple login form -->


					<?php include __DIR__ . '/footer.php'; ?>