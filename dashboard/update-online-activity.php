<?php

require __DIR__ . '/../bootstrap.php';

// Update user last login for online check
$isOnline = $user->update([
    'last_login' => time()
], $user->currentUserId());
