<?php

include_once("../db/crud.php");

function get_users($userId, $substr) {
	$query = "SELECT users.login, 
              EXISTS (SELECT 1 FROM knows_table WHERE user_id = '$userId' AND friend_id = users.id) AS isFriend 
              FROM users  
              WHERE users.login LIKE '%$substr%' AND users.id != '$userId'";
	$users = read($query);
	return $users;
}

function addFriendToDatabase($userId, $friendLogin) {
	$friendId = getIdByLogin($friendLogin);
    $query = "INSERT INTO knows_table (user_id, friend_id) VALUES ('$userId', '$friendId')";
    return create($query);
}

function getIdByLogin($login) {
	$query = "SELECT id FROM users WHERE login = '$login'";
	$result = read($query);

	if($result) {
		$row = $result[0];
		return $row['id'];
	} else {
		return false;
	}
}

?>