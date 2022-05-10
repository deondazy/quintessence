<?php
/**
 * Quintessence Get Users File
 */
if (!session_id()) {
    session_start();
}

use QF\Core\Util;

require __DIR__ . '/../bootstrap.php';

$users = $user->getAll("id != {$user->currentUserId()}", "last_login DESC");

foreach ($users as $usr) :
    $lastLogin = date('Y-m-d H:i:s', $usr->last_login);
    $timeNow = strtotime(date('Y-m-d H:i:s') . '-10 seconds');
    $timeNow = date('Y-m-d H:i:s', $timeNow);

    $status = ($lastLogin > $timeNow) ? 'Online' : 'Offline';
?>
<li class="media">
    <div id="<?php echo $usr->id; ?>" class="media-link">
        <div class="media-left"><img src="<?php echo $user->getProfilePicture($usr->id); ?>"
                class="img-circle img-md" alt="<?php echo $usr->first_name; ?>'s Profile Picture"></div>
        <div class="media-body">
            <span class="media-heading text-semibold">
            <?php echo ucfirst($usr->first_name); ?> <?php echo ucfirst($usr->last_name); ?>
            </span>
            <span class="text-size-small text-muted display-block"><?php echo $status; ?></span>
        </div>
        <div class="media-right media-middle">
            <?php if ($status == 'Online') : ?>
                <span class="status-mark bg-success"></span>
            <?php else : ?>
                <span class="status-mark bg-grey-600"></span>
            <?php endif; ?>
        </div>
    </div>
</li>
<?php endforeach; ?>
