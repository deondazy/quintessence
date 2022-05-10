<?php

namespace QF\Core;

class Fund extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('funds');
    }
}
