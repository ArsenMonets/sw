<?php
    session_start();
    include("login_functions.php");
    $er = log_in_with_check($_POST);
    if(!$er) {
        header("Location: profile.php");
        die;
    }
?>