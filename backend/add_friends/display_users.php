<?php

session_start();
include_once("add_friends_functions.php");

if (!isset($_SESSION['id'])) {
    echo json_encode([]);
    exit;
}

$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$suggestedFriends = get_users($_SESSION['id'], $query);

if (!empty($suggestedFriends)) {
    echo json_encode(array_values($suggestedFriends));
} else {
    echo json_encode([]);
}
?>