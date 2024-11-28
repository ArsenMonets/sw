<?php

/**
 * Checks if any of the elements in the provided associative array are empty.
 *
 * @param array $data The associative array to check for empty values.
 *                    The keys represent field names, and the values are the data to be checked.
 *
 * @return string A string containing a list of the keys where the corresponding values are empty,
 *                formatted with each key and the message "is empty" on a new line.
 *                If no empty values are found, an empty string is returned.
 */
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