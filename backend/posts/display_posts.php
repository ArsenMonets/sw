<?php

session_start();
include_once("../posts/post_functions.php");

if (!isset($_SESSION['id'])) {
    echo json_encode([]);
    exit;
}

$type = isset($_GET['type']) ? $_GET['type'] : 'all'; 

$posts = [];

switch ($type) {
    case 'my':
        $posts = getPostsFromUser($_SESSION['id']);
        break;

    case 'friends':
        $posts = getPostsFromFriends($_SESSION['id']);
        break;

    case 'all':
        $posts = getAllPosts($_SESSION['id']);
        break;

    default:
        $posts = getAllPosts($_SESSION['id']);
        break;
}

if (!empty($posts)) {
    echo json_encode(array_values($posts));
} else {
    echo json_encode([]);
}
?>