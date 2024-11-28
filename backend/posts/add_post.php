<?php

include(dirname(__DIR__) . "/posts/post_functions.php");
$_POST['userid'] = $_SESSION['id'];
$er = add_post($_POST);
if(!$er) {
    header("Location: profile.php");
    die;
}

?>