<?php

include_once(dirname(__DIR__) . "/db/crud.php");
include_once(dirname(__DIR__) . "/utils.php");
/**
 * Handles user login by validating input, verifying credentials, 
 * and establishing a user session on successful authentication.
 * This function performs the following steps:
 * 1. Validates that all required input fields are provided.
 * 2. Queries the database to fetch user credentials based on the provided login.
 * 3. Verifies the provided password against the hashed password stored in the database.
 * 4. If the credentials are valid, initializes a session by setting the user's ID in `$_SESSION`.
 * 5. Returns error messages if validation or authentication fails.
 * 
 * @param array $data An associative array containing the login data:
 *  - 'login': The user's login (username or email).
 *  - 'password': The user's password.
 * 
 * @return string|false Returns:
 *  - A string with an error message if the login fails (e.g., "Wrong login", "Wrong password").
 *  - `false` if the login is successful.
 * 
 * Dependencies:
 * - `check_if_empty($data)` from `utils.php`: Checks if required fields are empty.
 * - `read($query, $params)` from `crud.php`: Executes a SELECT query with prepared statements.
 * 
 */
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