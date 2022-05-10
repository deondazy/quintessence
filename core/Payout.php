<?php

namespace QF\Core;

class Payout extends Base
{
    public function __construct($table = null)
    {
        ($table) ? $this->table = $table : parent::__construct('payouts');
    }

    /**
     * Check if payout exist
     *
     * @param int|string $txid The txid
     *
     * @return bool
     */
    public function exist($txid)
    {
        $query = Database::instance()->query("SELECT COUNT('id') FROM {$this->table} WHERE `txid` = :txid");
        $query->bindValue(':txid', $txid);
        $query->execute();
        if ($query->fetchColumn() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Paginate item result set
     *
     * @param int $limit
     * @param  int $offset
     * @param string $order
     * @return object
     */
    public function paginate($limit = 10, $offset = 1, $order = null)
    {
        $result = [];
        $query = "";
        if (!is_null($order)) {
            $query .= " ORDER BY {$order}";
        }
        if (!empty($limit)) {
            $query .= " LIMIT {$offset}, {$limit}";
        }
        Database::instance()->query(Database::instance()->lastQuery.$query);
        $result = Database::instance()->fetchAll();
        return $result;
    }
}
