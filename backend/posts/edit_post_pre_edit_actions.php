<?php
include_once("../backend/posts/post_functions.php");
if (isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $post = getPostById($postId);
        if (!$post) {
            $er = "Post not found!";
        }
    } else {
        $er = "No post ID specified!";
    }
?>