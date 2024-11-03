<?php

session_start();
include_once("add_friends_functions.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$friendLogin = isset($_GET['friend']) ? $_GET['friend'] : '';

if (empty($friendLogin)) {
    echo json_encode(['success' => false, 'message' => 'No friend specified.']);
    exit;
}

$added = addFriendToDatabase($_SESSION['id'], $friendLogin); 

if ($added) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add friend.']);
}