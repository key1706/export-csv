<?php
/**
 * @author TruongHV1
 */

namespace Core;

class ConnectionManager {
	/**
	 *
	 * @var resource
	 */
	private $connection = null;

	public function __construct() {
	    $servername = "localhost";
	    $username = "root";
	    $password = "";
	    $db = "csv";

	    try {
	        $this->connection = mysqli_connect ( $servername, $username, $password, $db );
	        // echo "Connected successfully";
	    } catch ( \Exception $e ) {
	        die("Connection failed: " . $e->getMessage());
	    }
	}

    /**
     * Returns the connection instance.
     *
     * @return ConnectionManagerInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     *
     * @param string $sql
     * @return unknown
     */
    public function execute($sql) {
        return mysqli_query($this->connection, $sql);
    }

    /**
     *
     * @param string $flag
     * @return unknown
     */
    public function setAutoCommit($flag = false) {
        return mysqli_autocommit($this->connection, false);
    }

    /**
     * Commit
     * @return unknown
     */
    public function commit() {
        return mysqli_commit($this->connection);
    }

    /**
     * Rollback data
     * @return unknown
     */
    public function rollback() {
        return mysqli_rollback($this->connection);
    }
}