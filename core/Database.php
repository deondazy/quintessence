<?php

namespace QF\Core;

use QF\Core\Exception\DatabaseException;
use PDO;
use PDOStatement;
use PDOException;

class Database
{
    /**
     * Database instance.
     *
     * @var PDO
     */
    private static $instance;

    /**
     * The active PDO connection.
     *
     * @var PDO
     */
    //private PDO $pdo;

    /**
     * The prepared PDOStatement.
     *
     * @var PDOStatement
     */
    private $statement;

    /**
     * Connection options.
     *
     * @var array
     */
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        // Disable multi query execution
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
    ];

    /**
     * The last Query string.
     *
     * @var string
     */
    public $lastQuery;

    /**
     * This class cannot be instantiated
     */
    private function __construct()
    {
    }

    /**
     * This class cannot be cloned
     */
    private function __clone()
    {
    }

    /**
     * Database object instance
     */
    public static function instance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Connect to the Database.
     *
     * Sets connection options, and connect to the Database
     *
     * @param string $dsn Data Source Name for the database driver
     * @param string $username Database username
     * @param string $password Database password
     *
     * @return PDO
     */
    public function connect($dsn, $username = null, $password = null)
    {
        // Are we already connected?
        if ($this->isConnected()) {
            return $this->pdo;
        }

        if ($dsn instanceof PDO) {
            $this->pdo = $dsn;
            return $this->pdo;
        }
        
        $options = $this->options;

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new DatabaseException("{$e->getMessage()} in {$e->getFile()} on line {$e->getLine()} <br> {$e->getTraceAsString()} <br> {$e->getCode()}");
        }

        return $this->pdo;
    }

    /**
     * Checks if there's an active Database connection.
     *
     * @return bool
     */
    public function isConnected()
    {
        return isset($this->pdo);
    }

    /**
     * Close database connection (Clean up).
     */
    public function close()
    {
        $this->pdo       = null;
        $this->statement = null;
    }

    /**
     * Prepare a query to run against the database.
     *
     * @param string $query
     *
     * @throws DatabaseException
     *
     * @return PDOStatement
     */
    public function query($query)
    {
        $this->connect($this->pdo);

        try {
            $this->statement = $this->pdo->prepare($query);

            if ($this->statement instanceof PDOStatement) {
                $this->lastQuery = $this->statement->queryString;
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e->getMessage());
        }
        
        return $this->statement;
    }

    /**
     * Bind the inputs with the query placeholders.
     *
     * @param string $param
     * @param string $value
     * @param string $type
     *
     * @return bool
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        return $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement.
     *
     * @throws DatabaseException
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ($this->statement instanceof PDOStatement) {
                return $this->statement->execute();
            }
        } catch (PDOException $e) {
            throw new DatabaseException($e->getMessage());
        }
    }

    /**
     * Execute prepared statement and fetch array of all the result set rows.
     *
     * @return array
     */
    public function fetchAll()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Execute the prepared statement and fetch a single row from the result set.
     *
     * @return object
     */
    public function fetchOne()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Count the affected rows returned by the last query.
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }

    /**
     * The last AUTO_INCREMENTed id for the last INSERT query.
     *
     * @return int
     */
    public function lastInsertId()
    {
        return (int)$this->pdo->lastInsertId();
    }
}
