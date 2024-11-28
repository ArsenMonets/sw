<?php

include_once("../../db/crud.php");

/**
 * Retrieve the number of likes for a specific post.
 *
 * @param int $postId The ID of the post.
 * @return mixed The number of likes for the post or false on failure.
 */
function get_post_likes($postId) {
    $query = "SELECT likes FROM posts WHERE id = ?";
    $params = [$postId];
    return read($query, $params);
}

/**
 * Update the number of likes for a specific post.
 *
 * @param int $postId The ID of the post.
 * @param int $newLikes The new number of likes to set for the post.
 * @return bool True on success, false on failure.
 */
function update_post_likes($postId, $newLikes) {
    $updateQuery = "UPDATE posts SET likes = ? WHERE id = ?";
    $updateParams = [$newLikes, $postId];
    return update($updateQuery, $updateParams);
}

/**
 * Check if a user has liked a specific post.
 *
 * @param int $userId The ID of the user.
 * @param int $postId The ID of the post.
 * @return mixed The user's like record if it exists, or false if it doesn't.
 */
function check_user_like($userId, $postId) {
    $query = "SELECT * FROM users_likes WHERE userid = ? AND postid = ?";
    $params = [$userId, $postId];
    return read($query, $params);
}

/**
 * Add a like for a post by a specific user.
 *
 * @param int $userId The ID of the user.
 * @param int $postId The ID of the post.
 * @return bool True on success, false on failure.
 */
function add_user_like($userId, $postId) {
    $insertQuery = "INSERT INTO users_likes (userid, postid) VALUES (?, ?)";
    $params = [$userId, $postId];
    return create($insertQuery, $params);
}

/**
 * Remove a like for a post by a specific user.
 *
 * @param int $userId The ID of the user.
 * @param int $postId The ID of the post.
 * @return bool True on success, false on failure.
 */
function remove_user_like($userId, $postId) {
    $deleteQuery = "DELETE FROM users_likes WHERE userid = ? AND postid = ?";
    $params = [$userId, $postId];
    return delete($deleteQuery, $params);
}

?>