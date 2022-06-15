<?php

$config = new QF\Core\Config;

// Database configuration settings
$config->database = [
    'name'         => '',
    'host'         => '',
    'user'         => '',
    'password'     => '',
    'table_prefix' => '',
];

// Database table configurations
$config->database_tables = [
    'chats'    => $config->database->table_prefix . 'chats',
    'sessions' => $config->database->table_prefix . 'sessions',
    'requests' => $config->database->table_prefix . 'requests',
    'users'    => $config->database->table_prefix . 'users',
];

// Debug configuration settings
$config->debug = [
    'on'       => true, // True for Development, False for Production
    'logPath'  => __DIR__ . '/error.log', // Path to log file
];

// Site configuration settings
$config->site = [
    'name'             => 'Quintessence Fraternity',
    'url'              => '',
    'desc'             => 'Quintessence Fraternity Official Website',
    'key'              => '',
    'phone'            => '',
    'email'            => '', // Email address to send emails to
    'security_email'   => '', // Email address to send security emails to   
    'noreply_email'    => '', // Email address to send no-reply emails to
    'career_email'     => '', // Email address to send career emails to
    'request_expire'   => strtotime('+1 day'), // Expiration time for requests
    'captcha_secret'   => '', // Google recaptcha secret key
    'captcha_site_key' => '', // Google recaptcha site key
    'address'          => '', // Address to display on the contact page
];

// Cookie configuration settings
$config->cookie = [
    'login' => [
        'name'   => 'qf_auth', 
        'expire' => strtotime('+30 days'),
    ],
    '_2fa' => [
        'name' => 'qf_2fa_auth', 
        'secret' => '',
        'expire' => strtotime('+30 days'),
    ]
];

// Mail configuration settings
$config->mail = [
    'mailgun_api_key' => '',
    'domain'          => '',
];

// Paystack keys
$config->payment = [
    'paystack_api_live_key' => '',
    'paystack_api_test_key' => '',
];
