<?php

include("connect.php");

function create($query, $params) {
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

function delete($query, $params) {
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