<?php
include_once("like_functions.php"); 

session_start();
$postId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = $_SESSION['id'];

if ($postId > 0 && $userId > 0) {
    $existingLike = check_user_like($userId, $postId);

    if ($existingLike && count($existingLike) > 0) {
        echo json_encode([
            "success" => false,  
            "message" => "You have already liked this post"
        ]);
    } else {
        $result = get_post_likes($postId);

        if ($result && count($result) > 0) {
            $newLikes = $result[0]['likes'] + 1;
            $updateResult = update_post_likes($postId, $newLikes);

            if ($updateResult) {
                $addLikeResult = add_user_like($userId, $postId);

                if ($addLikeResult) {
                    echo json_encode([
                        "success" => true,  
                        "message" => "Post liked successfully"
                    ]);
                } else {
                    echo json_encode([
                        "success" => false,  
                        "message" => "Failed to record your like"
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
    }
} else {
    echo json_encode([
        "success" => false,  
        "message" => "Invalid post ID or user ID"
    ]);
}
?>
