<?php

include_once("../backend/db/crud.php");
include_once("../backend/utils.php");

function add_post($data) {
	$error = check_if_empty($data);
	if ($error) {
        return $error;
    }
    $userid = $data['userid'];
	$post_title = $data['post_title'];
	$post_content = $data['post_content'];
	$query = "INSERT INTO posts (userid, top, text) VALUES ('$userid', '$post_title', '$post_content')";
	create($query);
	return false;
}

?>