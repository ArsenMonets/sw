<?php

include_once("../db/crud.php");
/**
 * Retrieve a list of users whose login contains a specific substring, 
 * excluding the given user, and indicate whether they are friends with the user.
 *
 * @param int $userId The ID of the current user.
 * @param string $substr The substring to search for in user logins.
 * @return array|false An array of users with their friendship status or false on failure.
 */
function get_users($userId, $substr) {
    $query = "
        SELECT users.login, 
               isUserFriend(?, users.id) AS isFriend
        FROM users  
        WHERE users.login LIKE ? AND users.id != ?
    ";
    $users = read($query, [$userId, "%$substr%", $userId]);
    return $users;
}
/**
 * Add a friend to the user's friend list based on the friend's login.
 *
 * @param int $userId The ID of the current user.
 * @param string $friendLogin The login of the friend to be added.
 * @return bool True on success, false on failure.
 */
function add_friend_to_database($userId, $friendLogin) {
    $friendId = get_id_by_login($friendLogin);
    $query = "INSERT INTO knows_table (user_id, friend_id) VALUES (?, ?)";
    return create($query, [$userId, $friendId]);
}
/**
 * Remove a friend from the user's friend list based on the friend's login.
 *
 * @param int $userId The ID of the current user.
 * @param string $friendLogin The login of the friend to be removed.
 * @return bool True on success, false on failure.
 */
function remove_friend_from_database($userId, $friendLogin) {
    $friendId = get_id_by_login($friendLogin);
    $query = "DELETE FROM knows_table WHERE user_id = ? AND friend_id = ?";
    return delete($query, [$userId, $friendId]);
}
/**
 * Check if a user is a friend of the given user based on the friend's login.
 *
 * @param int $userId The ID of the current user.
 * @param string $friendLogin The login of the potential friend.
 * @return bool True if the user is a friend, false otherwise.
 */
function is_user_friend($userId, $friendLogin) {
    $friendId = get_id_by_login($friendLogin);
    $query = "SELECT 1 FROM knows_table WHERE user_id = ? AND friend_id = ?";
    $result = read($query, [$userId, $friendId]);
    return !empty($result); 
}
/**
 * Get the ID of a user based on their login.
 *
 * @param string $login The login of the user.
 * @return int|false The user's ID or false if the user is not found.
 */
function get_id_by_login($login) {
    $query = "SELECT id FROM users WHERE login = ?";
    $result = read($query, [$login]);

    if($result) {
        $row = $result[0];
        return $row['id'];
    } else {
        return false;
    }
}

?>