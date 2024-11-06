<?php
	$inf;
	include("../backend/profile/profile_actions.php");
?>

<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css" />
    <title> Profile | <?php echo $inf['login'] ?> </title>
</head>

<body>
	<div id = "top">
		<h2>Welcome <?php echo $inf['login'] ?>! </h2>
		<form action="../backend/profile/logout.php" method="post">
            <button id="pb" type="submit" class="btn btn-danger">X</button>
            <a id="pa" href="post.php" class="btn btn-secondary">Post</a>
            <a id="pa" href="add_friends.php" class="btn btn-warning">Add friends</a>
            <button id="btnReload" type="button" class="btn btn-success">
                  <i class="fas fa-sync"></i>
            </button>
            <button id="btnAllPosts" type="button" class="btn btn-info">All posts</button>
            <button id="btnFriendsPosts" type="button" class="btn btn-warning">Posts from friends</button>
            <button id="btnMyPosts" type="button" class="btn btn-secondary">My posts</button>
        </form>
	</div>
    <h4>Posts</h4>    
    <ul class="list-group" id="postList"></ul>
    <script src="js/postDisplay.js"></script>
</body>

