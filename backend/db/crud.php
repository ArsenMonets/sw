<?php

include("connect.php");

function create($query) {
	$conn = Connection::connect();
	$result = mysqli_query($conn, $query);

	if(!$result) {
		return false;
	} else {
		return true;
	}
}

function read($query) {
	$conn = Connection::connect();
	$result = mysqli_query($conn, $query);

	if(!$result) {
		return false;
	} else {
		$data = false;
		while($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;
	}
}