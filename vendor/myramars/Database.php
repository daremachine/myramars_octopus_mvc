<?php declare(strict_types=1);

/**
 * Myramars Octopus MVC
 * Feel free contact me Jakub Hantak<info@myramars.cz>
 * @License MIT
 */

/**
 * Database PDO abstraction
 */
class Database
{
    private $_connection;
    private $_host;
    private $_user;
    private $_dbName;
    private $_pass;

    public function __construct($host, $user, $dbName, $pass)
    {
        $this->_host = $host;
        $this->_user = $user;
        $this->_dbName = $dbName;
        $this->_pass = $pass;
    }

    /**
     * Executes the SQL query with values
     *
     * @param string $query raw SQL query statement
     * @param array  $params array replaced as prepare statements [ column => value ]
     */
    public function fromQuery(string $query, array $params = [])
    {
        $smtp = $this->_connection->prepare($query);
        $smtp->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $smtp->execute($params);

        $data = [];

        if ($result) {
            while ($row = $smtp->fetch()) {
                $data[] = $row;
            }

            $smtp = null;

            if (count($data) === 1) {
                $data = $data[0];
            }
            else if (count($data) === 0) {
                $data = false;
            }

            if (strpos($query, "INSERT INTO") !== false) {
                $data = $this->_connection->lastInsertId();
            }
        }

        return $data;
    }

    /**
     * Insert record helper
     *
     * @param string $table tablename
     * @param array $params [column => value]
     */
    public function insert(string $table, array $params = []): int
    {
        if(count($params) == 0)
            throw new Exception("Insert empty array of values to table {$table}");

        $columns = implode(', ', array_keys($params));
        $questionMarks = substr(str_repeat("?,", count($params)), 0, -1);

        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$questionMarks})";

        return $this->fromQuery($query, $params);
    }

    /**
     * Update record helper
     * 
     * Remove tableName_id;id automatically
     * 
     * @param string $table tablename
     * @param array $params [column => value]
     * @param array $where [column => value] with always equals AND
     * 
     * @return int
     */
    public function update(string $table, array $params = [], array $where = []): int
    {
        if(count($params) == 0)
            throw new Exception("Insert empty array of values to table {$table}");
        if(count($where) == 0)
            throw new Exception("Insert empty array of where conditions to table {$table}");    

        $columns = implode(', ', array_keys($params));
        $questionMarks = substr(str_repeat("?,", count($params)), 0, -1);

        $whereClause = "";
        foreach($params as $column => $value)
            $whereClause .= "{$column}=? AND ";

        $whereClause = substr($whereClause, 0, -5);

        $dataStr = "";
        foreach($params as $column => $value)
            $dataStr .= "{$column}=?, ";

        $dataStr = substr($dataStr, 0, -2);

        // remove id column from data
        unset($params["id"]);
        unset($params["{$table}_id"]);

        $query = "UPDATE {$table} SET {$dataStr} WHERE {$whereClause}";

        $params = array_merge($params, $where);

        return $this->fromQuery($query, $params);
    }

    /**
     * Delete record helper
     * 
     * @param string $table tablename
     * @param array $where [column => value] with always equals AND
     * 
     * @return int
     */
    public function delete(string $table, array $where = []): int
    {
        if(count($where) == 0)
            throw new Exception("Insert empty array of values to table {$table}");

        $columns = implode(', ', array_keys($params));
        $questionMarks = substr(str_repeat("?,", count($params)), 0, -1);

        $whereClause = "";
        foreach($params as $column => $value)
            $whereClause .= "{$column}=? AND ";

        $whereClause = substr($whereClause, 0, -5);

        $query = "DELETE FROM {$table} WHERE {$whereClause}";

        return $this->fromQuery($query, $params);
    }

    /**
     * Get the last id of the inserted value in the database
     * 
     * @return int
     */
    public function getLastId(): int
    {
        return $this->_connection->lastInsertId();
    }

    /**
     * Connect to the database MySQL
     */
    public function connect(): void
    {
        try {
            $$this->_connection = new \PDO("mysql:host=" . $this->_host . ";port=3306;dbname=" . $this->_db_name, $this->_user, $this->_pass);
            $$this->_connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false); // true prepare statements

            $$this->_connection->exec("SET NAMES 'utf8'");
            $$this->_connection->exec("SET CHARACTER SET utf8");
            $$this->_connection->exec("SET CHARACTER_SET_CONNECTION=utf8");
        }
        catch (Exception $ex) {
            throw new $ex;
        }
    }

    /**
     * Kills the database connection, more info: https://php.net/pdo.connections
     */
    public function destruct(): void
    {
        //More info about this here: https://php.net/pdo.connections
        //KILL CONNECTION_ID()
        $this->_connection->query('SELECT pg_terminate_backend(pg_backend_pid());');
        $this->_connection = null;
    }
}