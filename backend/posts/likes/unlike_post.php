<?php
include_once("like_functions.php");

session_start();
$postId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = $_SESSION['id'];

if ($postId > 0 && $userId > 0) {
    $existingLike = checkUserLike($userId, $postId);

    if ($existingLike && count($existingLike) > 0) {
        $result = getPostLikes($postId);

        if ($result && count($result) > 0) {
            $newLikes = $result[0]['likes'] - 1;
            
            $updateResult = updatePostLikes($postId, $newLikes);

            if ($updateResult) {
                $removeLikeResult = removeUserLike($userId, $postId);

                if ($removeLikeResult) {
                    echo json_encode([
                        "success" => true, 
                        "message" => "Post unliked successfully"
                    ]);
                } else {
                    echo json_encode([
                        "success" => false, 
                        "message" => "Failed to remove your like"
                    ]);
                }
            } else {
                echo json_encode([
                    "success" => false, 
                    "message" => "Failed to update the likes"
                ]);
            }
        } else {
            echo json_encode([
                "success" => false, 
                "message" => "Post not found"
            ]);
        }
    } else {
        echo json_encode([
            "success" => false, 
            "message" => "You have not liked this post"
        ]);
    }
} else {
    echo json_encode([
        "success" => false, 
        "message" => "Invalid post ID or user ID"
    ]);
}
?>