<?php

include_once("../backend/db/crud.php");
include_once("../backend/utils.php");

function log_in_with_check($data) {
    $error = check_if_empty($data);
    if ($error) {
        return $error;
    }
    $login = $data['login'];
    $password = $data['password'];
    $query = "SELECT id, password FROM users WHERE login = ?";
    $result = read($query, [$login]);
    if ($result) {
        $row = $result[0];
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            return false;  
        } else {
            return "Wrong password <br>";
        }
    } else {
        return "Wrong login <br>";
    }
}

?>