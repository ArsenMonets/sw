<?php
	$er="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	include("../backend/register/register_actions.php");
	}
?>

<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css" />
    <title> Register </title>
</head>

<body>
	<div id = "top">
		<h2>Registration</h2>
	</div>
	<form id = "regform" action = "register.php" method = "post">
		<?php if ($er): ?>
			<div class="alert alert-danger" role="alert">
        		<?php echo $er; ?>
        	</div>
    	<?php endif; ?>
		<label for="login">Enter your login: </label>
		<input type="text" class="form-control" name="login" placeholder="Login" required>
		<label for="password">Enter your password: </label>
		<input type="password" class="form-control" name="password" placeholder="Password" required>
		<label for="repeat_password_input">Repeat your password: </label>
		<input type="password" class="form-control" name="repeat_password_input" placeholder="Repeat password" required>
		<input type="submit" class="btn btn-primary" id="button" value="register">
		<div id = "ref">
    		<a href="login.php">Return to login</a>
		</div>
	</form>
</body>