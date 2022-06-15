<?php
/**
 * Quintessence Fraternity Login Screen
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../../bootstrap.php';

if ($user->isLogged()) {
    $user->update(['online' => 0], $user->currentUserId());

	$hash = Util::escape($_COOKIE[$config->cookie->login['name']]);
	
    if ($user->logout($hash)) {
	    Util::flash('logout', 'You have logged out', 'alert alert-success');
    	Util::redirect($site->url . '/dashboard/auth/login/');
    }
}
