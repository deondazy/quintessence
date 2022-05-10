<?php
/*
	CoinPayments.net API Class - v1.0
	Copyright 2014-2016 CoinPayments.net. All rights reserved.
	License: GPLv2 - http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace QF\Core;

class CoinPaymentsAPI {
	/**
	 * API Private Key
	 *
	 * @var string
	 */
	private $privateKey;

	/**
	 * API Public Key
	 *
	 * @var string
	 */
	private $publicKey;

	/**
	 * cURL handle
	 *
	 * @var resource
	 */
	private $ch;

	/**
	 * Constructor initialize the setup
	 *
	 * @param string $privateKey
	 * @param string $publicKey
	 */
	public function __construct($privateKey, $publicKey)
	{
		$this->privateKey = $privateKey;
		$this->publicKey = $publicKey;
		$this->ch = null;
	}

	/**
	 * Creates an address for receiving payments into your CoinPayments Wallet.
	 *
	 * @param string $currency The cryptocurrency to create a receiving address for.
	 * @param string $ipnUrl Optionally set an IPN handler to receive notices about this transaction.
	 * If ipnUrl is empty then it will use the default IPN URL in your account.
	 *
	 * @return array
	 */
	public function GetCallbackAddress($currency, $ipnUrl = '')
	{
		$req = [
			'currency' => $currency,
			'ipn_url' => $ipnUrl,
		];
		return $this->apiCall('get_callback_address', $req);
	}


	/**
	 * Checks that the required keys are set
	 */
	private function isSetup()
	{
		return (!empty($this->privateKey) && !empty($this->publicKey));
	}

	/**
	 * Calls the coinpayments.net API
	 *
	 * @param string $cmd
	 * @param array $req
	 */
	private function apiCall($cmd, array $req = [])
	{
		if (!$this->isSetup()) {
			return ['error' => 'You have omitted your private and public keys!'];
		}

		// Set the API command and required fields
    	$req['version'] = 1;
		$req['cmd'] = $cmd;
		$req['key'] = $this->publicKey;
		$req['format'] = 'json'; //supported values are json and xml

		// Generate the query string
		$post_data = http_build_query($req, '', '&');

		// Calculate the HMAC signature on the POST data
		$hmac = hash_hmac('sha512', $post_data, $this->privateKey);

		// Create cURL handle and initialize (if needed)
		if ($this->ch === null) {
			$this->ch = curl_init('https://www.coinpayments.net/api.php');
			curl_setopt($this->ch, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		}
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);

		$data = curl_exec($this->ch);

		if ($data !== FALSE) {
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
				// We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
				$dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
			} else {
				$dec = json_decode($data, TRUE);
			}

			if ($dec !== NULL && count($dec)) {
				return $dec;
			} else {
				// If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
				return ['error' => 'Unable to parse JSON result ('.json_last_error().')'];
			}
		} else {
			return ['error' => 'cURL error: '.curl_error($this->ch)];
		}
	}
}
