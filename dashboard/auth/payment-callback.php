<?php

if (!session_id()) {
    session_start();
}

use Matscode\Paystack\Transaction;
use Matscode\Paystack\Utility\Debug; // for Debugging purpose
use Matscode\Paystack\Utility\Http;
use QF\Core\Util;

require __DIR__ . '/../../bootstrap.php';

$secretKey = $config->payment->paystack_api_test_key;

// creating the transaction object
$Transaction = new Transaction($secretKey);

$response = $Transaction->verify();

if ($response->data->status == 'success') {
    $authCode = $response->data->authorization->authorization_code;
    
    if ($user->update([
        'auth_code' => $authCode, 
        'paid' => 1], $user->currentUserId())) {
            Util::flash('success', 'Payment confirmed!', 'alert alert-success');
            Util::redirect($site->url . '/dashboard/');
    }
}


