<?php

if (file_exists("../backend/db/crud.php")) {
    include_once("../backend/db/crud.php");
} else {
    include_once("../db/crud.php");
}
if (file_exists("../backend/utils.php")) {
    include_once("../backend/utils.php");
} else {
    include_once("../utils.php");
}

function addPost($data) {
    $error = check_if_empty($data);
    if ($error) {
        return $error;
    }

    $userid = $data['userid'];
    $post_title = $data['post_title'];
    $post_content = $data['post_content'];

    $query = "INSERT INTO posts (userid, top, text) VALUES (?, ?, ?)";
    create($query, [$userid, $post_title, $post_content]);

    return false;
}


function getPostsFromFriends($id) {
    $query = "
        SELECT users.login, posts.top, posts.text
        FROM posts
        INNER JOIN users ON users.id = posts.userid
        WHERE isUserFriend(?, posts.userid) = TRUE
    ";

    return read($query, [$id]);
}

function getAllPosts($id) {
    $query = "
        SELECT users.login, posts.top, posts.text 
        FROM posts 
        INNER JOIN users ON users.id = posts.userid
        WHERE posts.userid != ?
    ";

    return read($query, [$id]);
}

function getPostsFromUser($id) {
    $query = "
        SELECT posts.id, users.login, posts.top, posts.text
        FROM posts
        INNER JOIN users ON users.id = posts.userid
        WHERE posts.userid = ?
    ";
    return read($query, [$id]);
}

function checkIfPostOwnedByUser($userId, $postId) {
    $query = "SELECT 1 FROM posts WHERE id = ? AND userid = ?";
    $result = read($query, [$postId, $userId]);
    return count($result) > 0;
}

function removePostFromDatabase($postId) {
    $query = "DELETE FROM posts WHERE id = ?";
    return delete($query, [$postId]);
}

?>