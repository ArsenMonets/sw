<?php
    include("register_functions.php");
    $er = create_user_with_check($_POST);
    if(!$er) {
        header("Location: login.php");
        die;
    }
?>

