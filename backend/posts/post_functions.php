<?php

include_once(dirname(__DIR__) .  "/db/crud.php");
include_once(dirname(__DIR__) .  "/utils.php");


/**
 * Adds a new post to the database.
 *
 * @param array $data An associative array with keys:
 *   - 'userid': ID of the user creating the post.
 *   - 'post_title': Title of the post.
 *   - 'post_content': Content of the post.
 * @return mixed Error message if validation fails, or true/false based on the success of the operation.
 */
function add_post($data) {
    $error = check_if_empty($data);
    if ($error) {
        return $error;
    }

    $userid = $data['userid'];
    $post_title = $data['post_title'];
    $post_content = $data['post_content'];

    $query = "INSERT INTO posts (userid, top, text) VALUES (?, ?, ?)";

    return !create($query, [$userid, $post_title, $post_content]);
}

/**
 * Retrieves posts from friends of the given user.
 *
 * @param int $id User ID.
 * @return array List of posts with details (post ID, user login, title, content, likes, and user like status).
 */
function get_posts_from_friends($id) {
    $query = "
        SELECT posts.id, users.login, posts.top, posts.text, posts.likes, isUserLike(?, posts.id) AS is_user_like
        FROM posts
        INNER JOIN users ON users.id = posts.userid
        WHERE isUserFriend(?, posts.userid) = TRUE
    ";

    return read($query, [$id, $id]);
}

/**
 * Retrieves all posts except those created by the given user.
 *
 * @param int $id User ID.
 * @return array List of posts with details (post ID, user login, title, content, likes, and user like status).
 */
function get_all_posts($id) {
    $query = "
        SELECT posts.id, users.login, posts.top, posts.text,
            posts.likes, isUserLike(?, posts.id) AS is_user_like
        FROM posts 
        INNER JOIN users ON users.id = posts.userid
        WHERE posts.userid != ?
    ";

    return read($query, [$id, $id]);
}

/**
 * Retrieves posts created by a specific user.
 *
 * @param int $id User ID.
 * @return array List of posts with details (post ID, user login, title, content, and likes).
 */
function get_posts_from_user($id) {
    $query = "
        SELECT posts.id, users.login, posts.top, posts.text, posts.likes
        FROM posts
        INNER JOIN users ON users.id = posts.userid
        WHERE posts.userid = ?
    ";
    return read($query, [$id]);
}

/**
 * Checks if a specific post is owned by a user.
 *
 * @param int $userId User ID.
 * @param int $postId Post ID.
 * @return bool True if the user owns the post, false otherwise.
 */
function check_if_post_owned_by_user($userId, $postId) {
    $query = "SELECT 1 FROM posts WHERE id = ? AND userid = ?";
    $result = read($query, [$postId, $userId]);
    return count($result) > 0;
}

/**
 * Removes a post from the database.
 *
 * @param int $postId Post ID.
 * @return bool True if the deletion was successful, false otherwise.
 */
function remove_post_from_database($postId) {
    $query = "DELETE FROM posts WHERE id = ?";
    return delete($query, [$postId]);
}

/**
 * Retrieves a post's details by its ID.
 *
 * @param int $postId Post ID.
 * @return array|bool Array containing 'top' (title) and 'text' (content) if the post exists, false otherwise.
 */
function get_post_by_id($postId) {
    $query = "SELECT top, text FROM posts WHERE id = ?";
    $params = [$postId]; 
    $result = read($query, $params);
    
    if (count($result) > 0) {
        return $result[0]; 
    }
    return false;
}

/**
 * Updates the title and content of a specific post.
 *
 * @param int $postId Post ID.
 * @param string $title New title for the post.
 * @param string $content New content for the post.
 * @return bool True if the update was successful, false otherwise.
 */
function update_post($postId, $title, $content) {
    $query = "UPDATE posts SET top = ?, text = ? WHERE id = ?";
    $params = [$title, $content, $postId]; 
    return update($query, $params); 
}

?>