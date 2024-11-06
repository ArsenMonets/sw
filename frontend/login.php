<?php
	$er="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include("../backend/login/login_actions.php");
	}
?>

<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css" />
    <title> Log in </title>
</head>

<body>
	<div id = "top">
		<h2>Log in</h2>
	</div>
	<form id = "form" action = "login.php" method = "post">
		<?php if ($er): ?>
			<div class="alert alert-danger" role="alert">
        		<?php echo $er; ?>
        	</div>
    	<?php endif; ?>
		<label for="login">Enter your login: </label>
		<input type="text" class="form-control" name="login" placeholder="Login" required>
		<label for="password"> Enter your password: </label>
		<input type="password" class="form-control" name="password" placeholder="Password" required>
		<input type="submit" class="btn btn-primary" id="button" value="log in">
		<div id = "ref">
    		<a href="register.php">Register</a>
		</div>
	</form>
</body>