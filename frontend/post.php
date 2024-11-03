<?php
    $inf;
    include("../backend/post/post_actions.php");
    $er="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../backend/post/add_post.php");
    }
?>

<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css"/>
    <title> Post | <?php echo $inf['login'] ?> </title>
</head>

<body>
    <div id = "top">
        <h2> You can post there </h2>
    </div>
    <div id="regform">
        <h3>Add a Post</h3>
            <form action="post.php" method="post">
                <?php if ($er): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $er; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="post_title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Enter post title" required>
                </div>
                <div class="mb-3">
                    <label for="post_content" class="form-label">Post Content</label>
                    <textarea class="form-control" name="post_content" id="post_content" rows="4" placeholder="Write your post here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="button">Post</button>
                <div id = "ref">
                    <a href="profile.php">Return to profile</a>
                </div>
            </form>
    </div>
</body>