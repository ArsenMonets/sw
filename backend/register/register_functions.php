<?php
include_once(dirname(__DIR__) . "/db/crud.php");
include_once(dirname(__DIR__) . "/utils.php");
/**
 * Validates and creates a new user account by checking input data for correctness, 
 * ensuring uniqueness of login and email, and storing the user's information in the database.
 * 
 * Steps:
 * 1. Validate all required fields are provided.
 * 2. Perform specific validations for login, password, and email.
 * 3. Ensure the login and email are unique in the database.
 * 4. If all checks pass, save the user's details in the database.
 *
 * @param array $data An associative array containing:
 *  - 'login': The desired username.
 *  - 'password': The user's chosen password.
 *  - 'repeat_password_input': Confirmation of the password.
 *  - 'email': The user's email address.
 * 
 * @return string|false Returns:
 *  - A string containing validation error messages if validation fails.
 *  - `false` if user creation is successful.
 * 
 * Dependencies:
 * - `check_if_empty($data)` (from `utils.php`): Checks for missing input fields.
 * - `is_unique_login($login)` (this file): Checks if the username is already in use.
 * - `is_unique_email($email)` (this file): Checks if the email is already in use.
 * - `create_user($data)` (this file): Inserts the new user record into the database.
 * - `read($query, $params)` (from `crud.php`): Executes a SELECT query with prepared statements.
 * - `create($query, $params)` (from `crud.php`): Executes an INSERT query with prepared statements.
 */
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
        $email = $data['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format<br>";
        }
        if (!is_unique_email($email)) {
            $error .= "Email already exists<br>";
        }
    }

	if ($error === "") {
		create_user($data);
        return false;
	} else {
		return $error;
	}
}

/**
 * Checks if a username is unique in the database.
 *
 * @param string $login The username to check.
 * @return bool Returns true if the username is unique, false otherwise.
 */
function is_unique_login($login) {
    $query = "SELECT COUNT(*) AS count FROM users WHERE login = ?";
    $result = read($query, [$login]);
    if (!empty($result)) {
        return $result[0]['count'] == 0;
    }
    return false;
}

/**
 * Checks if an email is unique in the database.
 *
 * @param string $email The email to check.
 * @return bool Returns true if the email is unique, false otherwise.
 */
function is_unique_email($email) {
    $query = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
    $result = read($query, [$email]);
    if (!empty($result)) {
        return $result[0]['count'] == 0;
    }
    return false;
}

/**
 * Inserts a new user record into the database.
 *
 * @param array $data An associative array containing:
 *  - 'login': The username.
 *  - 'password': The hashed password.
 *  - 'email': The user's email address.
 * @return bool Returns true on successful insertion, false otherwise.
 */
function create_user($data) {
	$login = $data['login'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    $email = $data['email'];
    $query = "INSERT INTO users (login, password, email) VALUES (?, ?, ?)";
    return create($query, [$login, $password, $email]);
}