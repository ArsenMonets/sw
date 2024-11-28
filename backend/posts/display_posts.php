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
        $posts = get_posts_from_user($_SESSION['id']);
        break;

    case 'friends':
        $posts = get_posts_from_friends($_SESSION['id']);
        break;

    case 'all':
        $posts = get_all_posts($_SESSION['id']);
        break;

    default:
        $posts = get_all_posts($_SESSION['id']);
        break;
}

if (!empty($posts)) {
    echo json_encode(array_values($posts));
} else {
    echo json_encode([]);
}
?>