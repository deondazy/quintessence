<?php

namespace QF\Core;

class UserPayout extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('user_payouts');
    }
}
