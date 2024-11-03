<?php
	$inf;
	include("../backend/profile/profile_actions.php");
?>

<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
        </form>
	</div>
</body>

