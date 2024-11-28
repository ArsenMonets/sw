<?php
    include_once(dirname(__DIR__) . "/posts/post_functions.php");
    $postId = $_GET['postId']; 
    $title = $_POST['post_title'];
    $content = $_POST['post_content'];

    if (!empty($title) && !empty($content)) {
        $updateSuccess = update_post($postId, $title, $content); 
        if ($updateSuccess) {
            header("Location: profile.php");
            exit();
        } else {
            $er = "There was an error updating your post.";
        }
    } else {
        $er = "Please fill in both the title and content.";
    }
?>