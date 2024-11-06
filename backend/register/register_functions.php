<?php

include_once("../backend/db/crud.php");
include_once("../backend/utils.php");

function create_user_with_check($data) {
	$error = check_if_empty($data);

	if ($error === "") {
		$login = $data['login'];
        if (strlen($login) < 3 || strlen($login) > 20) {
            $error .= "Login must be between 3 and 20 characters long<br>";
        }
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $login)) {
            $error .= "Login can only contain letters, numbers, and underscores<br>";
        }
        if (!is_unique_login($login)) {
            $error .= "Login already exists<br>";
        }
        if ($data['password'] !== $data['repeat_password_input']) {
            $error .= "Passwords do not match<br>";
        }
        if (strlen($data['password']) < 5) {
            $error .= "Password must be at least 5 characters long<br>";
        }
        if (!preg_match('/[A-Z]/', $data['password'])) {
            $error .= "Password must contain at least one uppercase letter<br>";
        }
        if (!preg_match('/[a-z]/', $data['password'])) {
            $error .= "Password must contain at least one lowercase letter<br>";
        }
        if (!preg_match('/[0-9]/', $data['password'])) {
            $error .= "Password must contain at least one number<br>";
        }
    }

	if ($error === "") {
		create_user($data);
        return false;
	} else {
		return $error;
	}
}

function is_unique_login($login) {
    $query = "SELECT COUNT(*) AS count FROM users WHERE login = ?";
    $result = read($query, [$login]);
    if (!empty($result)) {
        return $result[0]['count'] == 0;
    }
    return false;
}

function create_user($data) {
	$login = $data['login'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO users (login, password) VALUES (?, ?)";
    return create($query, [$login, $password]);
}