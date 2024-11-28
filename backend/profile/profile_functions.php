<?php

include_once(dirname(__DIR__) . "/db/crud.php");

/**
 * Fetches the login information of a user by their ID.
 *
 * @param int $id The ID of the user whose information is being retrieved.
 * @return array|false Returns an associative array containing the user's login information 
 *                     if the query is successful, or false if no data is found.
 */
function get_information($id) {
    $query = "SELECT login FROM users WHERE id = ?";
    $result = read($query, [$id]);
    if ($result) {
        $row = $result[0];
        return $row;
    } else {
        return false;
    }
}

?>