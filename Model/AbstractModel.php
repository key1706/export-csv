<?php
/**
 * @author TruongHV1
 */

namespace Model;

use Core\ConnectionManager;

abstract class AbstractModel {
    /**
     * Table name
     */
    protected $tableName = 'data';

    /**
     * ConnectionManager instance
     */
    protected $conn = null;

    public function __construct() {
        if ($this->conn == null) {
            $this->conn = new ConnectionManager();
        }
    }

    /**
     * Get table name of model
     */
    public function getTableName() {
        $class = explode('\\', get_class($this));

        return ($this->tableName ? $this->tableName : str_replace('Interface', '', array_pop($class)));
    }

    /**
     * Begin Transaction
     */
    public function beginTransaction(){
        $this->conn->setAutoCommit(false);
    }

    /**
     * Commit transaction
     */
    public function commit() {
        $this->conn->commit();
    }

    /**
     * Roll back transaction
     */
    public function rollback() {
        $this->conn->rollback();
    }

    /**
     * Find all applies no conditions
     *
     * @return array result
     */
    public function findAll()
    {
        $data = array();

        $result = $this->conn->execute("SELECT * FROM " . $this->getTableName() . " ORDER BY emp_id DESC");
        if (mysqli_num_rows($result) > 0) {
            while ( $row = mysqli_fetch_assoc ( $result ) ) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Delete table data
     */
    public function deleteAll()
    {
        return $this->conn->execute("DELETE FROM " . $this->getTableName());
    }
}
