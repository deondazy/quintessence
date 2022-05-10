<?php

namespace QF\Core;

abstract class Base
{
    /**
     * The Database Table;
     *
     * @var string
     */
    protected $table;

    /**
     * Constructor sets the Database Table.
     *
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Create a new record in the Database
     *
     * @param array $data The data ['column' => 'value'] to insert.
     *
     * @return int The number of inserted rows.
     */
    public function create(array $data)
    {
        $col   = '';
        $val   = '';

        foreach ($data as $column => $value) {
            $col .= "`{$column}`, ";
            $val .= ":{$column}, "; // use the column names as named parameter
        }

        $column = rtrim($col, ', '); // Remove last comma(,) on column names
        $value = rtrim($val, ', '); // Remove last comma(,) on named parameters

        // Construct the query
        Database::instance()->query("INSERT INTO {$this->table} ({$column}) VALUES ({$value})");

        //Bind all parameters
        foreach ($data as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        Database::instance()->execute();

        return Database::instance()->rowCount();
    }

    /**
     * Get a Value from a specific Column.
     *
     * @param string $field The column to get.
     * @param int $id The id of the value to get.
     *
     * @return mixed
     */
    public function get($field, $id)
    {
        $query = Database::instance()->query("SELECT $field FROM {$this->table} WHERE id = ?");
        $query->execute([$id]);

        if (Database::instance()->rowCount() == 0) {
            return null;
        }

        return Database::instance()->fetchOne()->$field;
    }

    /**
     * Get all entry from all columns
     *
     * @param string $where The WHERE clause for query.
     * @param string $order ORDER BY.
     *
     * @return array
     */
    public function getAll($where = null, $order = null)
    {
        $query = "SELECT * FROM {$this->table} ";

        if (!is_null($where)) {
            $query .= "WHERE {$where} ";
        }
        if (!is_null($order)) {
            $query .= "ORDER BY {$order}";
        }
        Database::instance()->query($query);
        
        return Database::instance()->fetchAll();
    }

    /**
     * Update a value in a column
     *
     * @param array $data ['colum' => 'value'] for update
     * @param int $id The id of the field to update
     *
     * @return int Number of updated columns
     */
    public function update(array $data, $id)
    {
        $set = '';

        foreach ($data as $column => $value) {
            // use column names as named parameters
            $set .= "{$column} = :{$column}, ";
        }
        
        $set = rtrim($set, ', '); // remove last comma(,)

        // Construuct the query
        Database::instance()->query("UPDATE {$this->table} SET {$set} WHERE id = :id");

        Database::instance()->bind(':id', $id);

        // Bind the {$set} parameters
        foreach ($data as $param => $value) {
            Database::instance()->bind(":{$param}", $value);
        }

        Database::instance()->execute();

        return Database::instance()->rowCount();
    }

    /**
     * Delete a value from a table's column
     *
     * @param int $id The id of the value to delete
     *
     * @return int
     */
    public function delete($id)
    {
        Database::instance()->query("DELETE FROM {$this->table} WHERE id = :id");
        Database::instance()->bind(':id', $id);
        Database::instance()->execute();
        
        return Database::instance()->rowCount();
    }

    /*
     * Count all rows in the table
     *
     * @return int
     */
    public function count()
    {
        return count($this->getAll());
    }
}
