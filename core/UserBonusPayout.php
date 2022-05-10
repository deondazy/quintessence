<?php

namespace QF\Core;

class UserBonusPayout extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('user_bonus_payouts');
    }
}
