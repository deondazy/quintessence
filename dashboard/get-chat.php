<?php

require __DIR__ . '/../bootstrap.php';

$chat = new QF\Core\Chat;
$chats = $chat->getAll();

foreach ($chats as $message) :
    if ($message->user_id === $user->currentUserId()) : ?>
        <li class="media reversed">
            <div class="media-body">
                <div class="media-content"><?php echo $message->content; ?></div>
                <span class="media-annotation display-block mt-10"><?php echo date('D, g:i a', $message->create_date); ?></span>
            </div>

            <div class="media-right">
                <a href="#">
                    <img src="<?php echo $user->getProfilePicture($message->user_id); ?>"
                        class="img-circle img-md" alt="">
                </a>
            </div>
        </li>
    <?php else : ?>
        <li class="media">
            <div class="media-left">
                <a href="#">
                    <img src="<?php echo $user->getProfilePicture($message->user_id); ?>"
                        class="img-circle img-md" alt="">
                </a>
            </div>

            <div class="media-body">
                <div class="madia-user">
                    <?php echo ucfirst($user->get('first_name', $message->user_id)); ?> <?php echo ucfirst($user->get('last_name', $message->user_id)); ?>
                </div>
                <div class="media-content">
                    <?php echo $message->content; ?>
                </div>
                <span class="media-annotation display-block mt-10"><?php echo date('D, g:i a', $message->create_date); ?></span>
            </div>
        </li>
    <?php endif;
endforeach;
