<?php

function check_if_empty($data) {
	$error = "";
	foreach ($data as $key => $value) {
		if(empty($value)) {
			$error = $error . $key . " is empty<br>";
		} 
	}
	return $error;
}

?>