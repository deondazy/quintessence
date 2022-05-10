<?php

namespace QF\Core;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    protected function add($message, array $args = [], $type)
    {
        // create a log channel
        $log = new Logger('Log');
        $log->pushHandler(new StreamHandler($this->config->debug->logPath, Logger::DEBUG));

        // add records to the log
        $log->$type($message, $args);
    }

    public function info($message, array $args = [])
    {
        $this->add($message, $args, 'info');
    }

    public function notice($message, array $args = [])
    {
        $this->add($message, $args, 'notice');
    }

    public function warning($message, array $args = [])
    {
        $this->add($message, $args, 'warning');
    }

    public function error($message, array $args = [])
    {
        $this->add($message, $args, 'error');
    }
}
