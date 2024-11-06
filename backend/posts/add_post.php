<?php

include("../backend/posts/post_functions.php");
$_POST['userid'] = $_SESSION['id'];
$er = addPost($_POST);
if(!$er) {
    header("Location: profile.php");
    die;
}

?>