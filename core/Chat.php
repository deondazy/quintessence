<?php

namespace QF\Core;

class Chat extends Base
{

    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('chats');
    }
}
