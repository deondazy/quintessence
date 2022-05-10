<?php

namespace QF\Core;

class KYC extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('kyc');
    }
}
