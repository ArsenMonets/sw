<?php

include_once("../backend/db/crud.php");

function get_information($id) {
	$query = "SELECT login FROM users WHERE id = '$id'";
	$result = read($query);

	if($result) {
		$row = $result[0];
		return $row;
	} else {
		return false;
	}

}

?>