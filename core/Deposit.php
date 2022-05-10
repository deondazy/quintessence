<?php

namespace QF\Core;

class Deposit extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('deposit_history');
    }
}
