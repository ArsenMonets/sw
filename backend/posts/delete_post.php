<?php
session_start();
include_once("post_functions.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$postId = isset($_GET['post_id']) ? $_GET['post_id'] : '';

if (empty($postId)) {
    echo json_encode(['success' => false, 'message' => 'No post specified.']);
    exit;
}

$owned = check_if_post_owned_by_user($_SESSION['id'], $postId); 

if (!$owned) {
    echo json_encode(['success' => false, 'message' => 'You do not own this post.']);
    exit;
}

$removed = remove_post_from_database($postId);

if ($removed) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove post.']);
}
?>