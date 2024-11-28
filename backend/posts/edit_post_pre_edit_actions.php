<?php
include_once(dirname(__DIR__) . "/posts/post_functions.php");
if (isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $post = get_post_by_id($postId);
        if (!$post) {
            $er = "Post not found!";
        }
    } else {
        $er = "No post ID specified!";
    }
?>