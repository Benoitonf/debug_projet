<?php

/**
 * Used to running database query
 *
 * @param string mysql query
 *
 * return mixed
 */
function run_query(string $query) {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    if ($connection->connect_errno) {
        throw new Exception("Database connection failed: " . $connection->connect_error);
    }

    if (!$result = $connection->query($query)) {
        throw new Exception("Query execution failed: " . $connection->error);
    }

    return $result;
}

/**
 * Used to create an INSERT query
 *
 * @param $table table name
 * @param $datas array the data to be inserted
 *
 * return bolean
 */
function insert(string $table, array $datas) {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    if ($connection->connect_errno) {
        throw new Exception("Database connection failed: " . $connection->connect_error);
    }

    $dataColumn = [];
    $dataValues = [];

    foreach ($datas as $column => $value) {
        $dataColumn[] = $connection->real_escape_string($column);
        $dataValues[] = "'" . $connection->real_escape_string($value) . "'";
    }

    $columns = implode(",", $dataColumn);
    $values = implode(",", $dataValues);
    
    $query = "INSERT INTO $table ($columns) VALUES ($values)";

    if (!$result = run_query($query)) {
        throw new Exception("Query execution failed: " . $connection->error);
    }

    return $result;
}

/**
 * @param string table name
 * @param string column
 * @param array conditions
 *
 * return array if has some data, false otherwise
 */
function select(string $table, string $column = null, $conditions = array()) {
    if(empty($column)) {
        $column = "*";
    }

    $query = "SELECT {$column} FROM {$table}";
    if(!empty($conditions)) {
        $query .= " WHERE {$conditions[0]} {$conditions[1]} '{$conditions[2]}'";
    }

    if (!$result = run_query($query)) {
        throw new Exception('Error when looking to the data');
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

/**
 *
 */
function find(string $table, array $conditions) {
    $result = select($table, null, $conditions);
    return $result[0];
}
