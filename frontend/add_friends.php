<?php
    $inf;
    include("../backend/add_friends/add_friends_actions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css"/>
    <title>Add Friends | <?php echo htmlspecialchars($inf['login']); ?></title>
</head>

<body>
    <div class="container mt-5">
        <div id="top" class="text-center mb-4">
            <h2>You Can Add Friends</h2>
            <div id = "ref">
                <a href="profile.php">Return to profile</a>
            </div>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search for friends..." id="friendSearch">
        </div>

        <h4>Suggested Friends</h4>
        <ul class="list-group" id="friendsList"></ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/friendSearch.js"></script>
</body>
</html>