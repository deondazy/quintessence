<?php

namespace QF\Core;

class Profit extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('profits');
    }
}
