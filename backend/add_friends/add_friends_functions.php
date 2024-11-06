<?php

include_once("../db/crud.php");

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

function addFriendToDatabase($userId, $friendLogin) {
    $friendId = getIdByLogin($friendLogin);
    $query = "INSERT INTO knows_table (user_id, friend_id) VALUES (?, ?)";
    return create($query, [$userId, $friendId]);
}

function removeFriendFromDatabase($userId, $friendLogin) {
    $friendId = getIdByLogin($friendLogin);
    $query = "DELETE FROM knows_table WHERE user_id = ? AND friend_id = ?";
    return delete($query, [$userId, $friendId]);
}

function isUserFriend($userId, $friendLogin) {
    $friendId = getIdByLogin($friendLogin);
    $query = "SELECT 1 FROM knows_table WHERE user_id = ? AND friend_id = ?";
    $result = read($query, [$userId, $friendId]);
    return !empty($result); 
}

function getIdByLogin($login) {
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