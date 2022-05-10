<?php

require __DIR__ . '/../bootstrap.php';

echo $user->get('last_login', $user->currentUserId());
