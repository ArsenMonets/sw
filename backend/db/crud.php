<?php
/**
 * A set of functions to perform CRUD operations (Create, Read, Update, Delete)
 * on a MySQL database using prepared statements for security.
 * 
 * Dependencies:
 * - Requires `connect.php` to include the `Connection` class for establishing a database connection.
 */
include_once("connect.php");
/**
 * Reads data from the database.
 * 
 * @param string $query The SQL SELECT query to execute.
 * @param array $params The parameters to bind to the query.
 * 
 * @return array|false An array of associative arrays representing the fetched rows,
 *                     or `false` on failure.
 */
function read($query, $params) {
    $conn = Connection::connect();
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
    
    $result = mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    
    $data = [];
    while ($row = mysqli_fetch_assoc($resultSet)) {
        $data[] = $row;
    }
    
    mysqli_stmt_close($stmt);
    
    return $data;
}
/**
 * Creates a new record in the database.
 * 
 * @param string $query The SQL INSERT query to execute.
 * @param array $params The parameters to bind to the query.
 * 
 * @return bool `true` on success, `false` on failure.
 */
function create($query, $params) {
    return save($query, $params);
}
/**
 * Deletes a record from the database.
 * 
 * @param string $query The SQL DELETE query to execute.
 * @param array $params The parameters to bind to the query.
 * 
 * @return bool `true` on success, `false` on failure.
 */
function delete($query, $params) {
    return save($query, $params);
}
/**
 * Updates a record in the database.
 * 
 * @param string $query The SQL UPDATE query to execute.
 * @param array $params The parameters to bind to the query.
 * 
 * @return bool `true` on success, `false` on failure.
 */
function update($query, $params) {
    return save($query, $params);
}
/**
 * Executes a non-SELECT query (INSERT, UPDATE, DELETE).
 * 
 * @param string $query The SQL query to execute.
 * @param array $params The parameters to bind to the query.
 * 
 * @return bool `true` on success, `false` on failure.
 */
function save($query, $params) {
    $conn = Connection::connect();
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt === false) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

?>