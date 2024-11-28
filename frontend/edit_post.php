<?php
    $inf;
    $er = "";
    $post;
    include("../backend/posts/post_actions.php");
    include("../backend/posts/edit_post_pre_edit_actions.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../backend/posts/edit_post.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css"/>
    <title>Edit Post | <?php echo $inf['login']; ?></title>
</head>
<body>
    <div id="top">
        <h2>Edit Your Post</h2>
    </div>
    <div id="form">
        <h3>Edit Post</h3>
        <form action="edit_post.php?postId=<?php echo $postId; ?>" method="post">
            <?php if ($er): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $er; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="post_title" id="post_title" 
                placeholder="Enter post title" value="<?php echo htmlspecialchars($post['top']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="post_content" class="form-label">Post Content</label>
                <textarea class="form-control" name="post_content" id="post_content" rows="4" 
                placeholder="Write your post here..." required><?php echo htmlspecialchars($post['text']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="button">Update Post</button>
            <div id="ref">
                <a href="profile.php">Return to profile</a>
            </div>
        </form>
    </div>
</body>
</html>