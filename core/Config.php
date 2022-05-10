<?php

namespace QF\Core;

class Config
{
    private $registry = [];

    /**
     * Checks if an entry exists in the registry
     *
     * @param string $key Key to check for in the registry
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->registry[$key]);
    }

    /**
     * Sets a record in the registry
     *
     * @param string $key Array key for the entry
     * @param string $val Value for the entry
     */
    public function __set($key, $val)
    {
        $newConfig = !isset($this->registry[$key]);

        if (!$newConfig) {
            return;
        }

        if (is_scalar($val)) {
            $this->registry[$key] = $val;
        } else {
            $this->registry[$key] = (object)$val;
        }
    }

    /**
     * Get a record from the registry
     *
     * @param string $key Array key for the record to get
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->registry)) {
            return $this->registry[$key];
        }

        $trace = debug_backtrace();

        trigger_error(
            'Undefined entry via __get(): ' . $key .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
}
