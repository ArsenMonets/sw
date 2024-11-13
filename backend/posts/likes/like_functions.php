<?php

include_once("../../db/crud.php"); 

function getPostLikes($postId) {
    $query = "SELECT likes FROM posts WHERE id = ?";
    $params = [$postId];
    return read($query, $params);
}

function updatePostLikes($postId, $newLikes) {
    $updateQuery = "UPDATE posts SET likes = ? WHERE id = ?";
    $updateParams = [$newLikes, $postId];
    return update($updateQuery, $updateParams);
}

function checkUserLike($userId, $postId) {
    $query = "SELECT * FROM users_likes WHERE userid = ? AND postid = ?";
    $params = [$userId, $postId];
    return read($query, $params);
}

function addUserLike($userId, $postId) {
    $insertQuery = "INSERT INTO users_likes (userid, postid) VALUES (?, ?)";
    $params = [$userId, $postId];
    return create($insertQuery, $params);
}

function removeUserLike($userId, $postId) {
    $deleteQuery = "DELETE FROM users_likes WHERE userid = ? AND postid = ?";
    $params = [$userId, $postId];
    return delete($deleteQuery, $params);
}

?>